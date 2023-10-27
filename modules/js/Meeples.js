define(['dojo', 'dojo/_base/declare'], (dojo, declare) => {
  function isVisible(elem) {
    return !!(elem.offsetWidth || elem.offsetHeight || elem.getClientRects().length);
  }

  return declare('altered.meeples', null, {
    setupMeeples() {
      // This function is refreshUI compatible
      let meepleIds = this.gamedatas.meeples.map((meeple) => {
        if (!$(`meeple-${meeple.id}`)) {
          this.addMeeple(meeple);
        }

        let o = $(`meeple-${meeple.id}`);
        if (!o) return null;

        let container = this.getMeepleContainer(meeple);
        if (o.parentNode != $(container)) {
          dojo.place(o, container);
        }
        o.dataset.state = meeple.state;

        return meeple.id;
      });
      document.querySelectorAll('.altered-meeple[id^="meeple-"]').forEach((oMeeple) => {
        if (!meepleIds.includes(parseInt(oMeeple.getAttribute('data-id'))) && oMeeple.getAttribute('data-type') != 'cylinder') {
          this.destroy(oMeeple);
        }
      });
      if (!$(`meeple-firstPlayer`)) {
        this.addMeeple({ id: 'firstPlayer', type: 'first-player' }, $(`firstPlayer-${this.gamedatas.firstPlayer}`));
      }
      this.updatePlayersCounters();
    },

    addMeeple(meeple, location = null) {
      if ($('meeple-' + meeple.id)) return;

      let container = location == null ? this.getMeepleContainer(meeple) : location;
      let o = this.place('tplMeeple', meeple, container);
      this.updateStatusIfCard(container);
      let tooltipDesc = this.getMeepleTooltip(meeple);
      if (tooltipDesc != null) {
        this.addCustomTooltip(o.id, tooltipDesc.map((t) => this.formatString(t)).join('<br/>'));
      }

      return o;
    },

    getMeepleTooltip(meeple) {
      let type = meeple.type;
      if (type == 'first-player') {
        return [_('First player')];
      }
      if (type == 'fleeting') {
        return [_('Fleeting: if I would be send to reserve, banish me instead.')];
      }
      return null;
    },

    tplMeeple(meeple) {
      let type = meeple.type.charAt(0).toLowerCase() + meeple.type.substr(1);
      const PERSONAL = ['companion', 'alterateur'];
      let faction = PERSONAL.includes(type) ? ` data-faction="${this.getPlayerFaction(meeple.pId)}" ` : '';
      return `<div class="altered-meeple altered-icon icon-${type}" id="meeple-${meeple.id}" data-id="${meeple.id}" data-type="${type}" data-state="${meeple.state}" ${faction}></div>`;
    },

    getPlayerColor(pId) {
      return this.gamedatas.players[pId].color;
    },

    getMeepleContainer(meeple) {
      let t = meeple.location.split('-');
      if (t[0] == 'storm') {
        let position = meeple.pId == this.player_id ? 'player' : 'opponent';
        return $(`storm-${t[1]}-${position}`);
      } else if ($(meeple.location)) {
        return $(meeple.location);
      }

      console.error('Trying to get container of a meeple', meeple);
      return 'game_play_area';
    },

    /**
     * Wrap the sliding animations
     */
    slideResources(meeples, configFn, syncNotif = true) {
      let fakeId = -1; // Used for virtual meeple that will get destroyed after animation (eg SCORE)
      let promises = meeples.map((resource, i) => {
        // Get config for this slide
        let config = typeof configFn === 'function' ? configFn(resource, i) : Object.assign({}, configFn);
        if (resource.destroy) {
          resource.id = fakeId--;
          config.destroy = true;
        }

        // Default delay if not specified
        let delay = config.delay ? config.delay : 100 * i;
        config.delay = 0;
        // Use meepleContainer if target not specified
        let target = config.target ? config.target : this.getMeepleContainer(resource);
        let from = config.from ? config.from : this.getMeepleContainer(resource);
        if (!isVisible(target)) {
          config.to = $(`overall_player_board_${resource.pId}`);
        }

        // Slide it
        let slideIt = () => {
          // Create meeple if needed
          if (!$('meeple-' + resource.id)) {
            this.addMeeple(resource);
          }
          let parent = $('meeple-' + resource.id).parentNode;

          // Slide it
          return new Promise((resolve, reject) => {
            this.slide('meeple-' + resource.id, target, config).then(() => {
              this.updateStatusIfCard(target);
              if (from != target) {
                this.updateStatusIfCard(from);
              }
              resolve();
            });
            this.updateStatusIfCard(parent);
          });
        };

        if (this.isFastMode()) {
          slideIt();
          return null;
        } else {
          return this.wait(delay - 10).then(slideIt);
        }
      });

      let endCallback = () => {
        if (syncNotif) {
          this.notifqueue.setSynchronousDuration(this.isFastMode() ? 0 : 10);
        }
      };

      if (this.isFastMode()) {
        endCallback();
        return Promise.resolve();
      } else
        return Promise.all(promises)
          .then(() => this.wait(10))
          .then(endCallback);
    },

    notif_addMeeples(n) {
      debug('Notif: adding & sliding meeples', n);
      this.slideResources(n.args.meeples, {
        from: this.getVisibleTitleContainer(),
      });
    },

    
    notif_looseMeeples(n) {
      debug('Loose of meeples', n);
      this.slideResources(n.args.meeples, {
        target: this.getVisibleTitleContainer(),
      });
    },

    notif_slideMeeples(n) {
      debug('Notif: sliding meeples', n);
      this.slideResources(n.args.meeples).then(() => this.updateCardCosts());

      if (n.args.icons) {
        this.gamedatas.players[n.args.player_id].icons = n.args.icons;
        this.updatePlayersIconsSummaries();
      }
    },

    notif_discardTokens(n) {
      debug('Notif: discard a token', n);
      this.slideResources(n.args.meeples, { destroy: true, to: this.getVisibleTitleContainer(), phantom: false });
    },

    notif_moveStormToken(n) {
      debug('Notif: moving a token in the storm', n);
      let slideIt = () => this.slideResources([n.args.token]);

      let card = n.args.revealed;
      if (card) {
        let oCard = $(`storm-card-container-${n.args.stormIndex}`).querySelector('.storm-card');
        this.flipAndReplace(
          oCard,
          `<div class='storm-card' data-id='${card.cardId % 10}' data-flipped='${card.rotated ? 1 : 0}'></div>`
        ).then(slideIt);
      } else {
        slideIt();
      }
    },

    notif_silentKill(n) {
      debug('Silent kill of meeples', n);
      n.args.tokens.forEach((meepleId) => {
        $(`meeple-${meepleId}`).remove();
      });    
    },



    notif_newFirstPlayer(n) {
      debug('Notif: new first player', n);

      this.forEachPlayer((player) => {
        let total = this._playerCounters[player.id]['totalMana'].getValue();
        this._playerCounters[player.id]['mana'].toValue(total);
      });

      // Slide first player
      let pId = n.args.player_id;
      this.gamedatas.firstPlayer = pId;
      this.slideResources([{ id: 'firstPlayer' }], { target: $(`firstPlayer-${pId}`) });
    },
  });
});
