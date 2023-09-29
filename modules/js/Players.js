define(['dojo', 'dojo/_base/declare'], (dojo, declare) => {
  // const PLAYER_COUNTERS = ['appeal', 'reputation', 'conservation', 'money', 'handCount', 'scoringHandCount', 'xtoken', 'income'];

  return declare('altered.players', null, {
    getPlayers() {
      return Object.values(this.gamedatas.players);
    },

    getPlayerFaction(pId) {
      return this.gamedatas.players[pId].faction;
    },

    isSolo() {
      return this.getPlayers().length == 1;
    },

    setupPlayers() {
      // Change No so that it fits the current player order view
      let currentNo = this.getPlayers().reduce((carry, player) => (player.id == this.player_id ? player.no : carry), 0);
      let nPlayers = Object.keys(this.gamedatas.players).length;
      this.forEachPlayer((player) => (player.order = (player.no + nPlayers - currentNo) % nPlayers));
      this.orderedPlayers = Object.values(this.gamedatas.players).sort((a, b) => a.order - b.order);

      // Add player board and player panel
      this.orderedPlayers.forEach((player, i) => {
        this.place('tplPlayerBoard', player, 'altered-main-container');

        // Panels
        this.place('tplPlayerPanel', player, `overall_player_board_${player.id}`);

        // Cards
        this.addCard(player.alterateur);
        player.hand.forEach((card) => this.addCard(card));
      });

      this.setupPlayersCounters();
    },

    // onChangeHandLocationSetting(v) {
    //   let hand = $(`hand-${this.player_id}`);
    //   let scoringHand = $(`scoring-hand-${this.player_id}`);
    //   if (hand) {
    //     let container = this.isFloatingHand() ? 'floating-hand' : `player-board-cards-${this.player_id}`;
    //     $(container).insertAdjacentElement('beforeend', hand);
    //     $(container).insertAdjacentElement('beforeend', scoringHand);
    //     $('floating-hand-wrapper').classList.toggle('active', this.isFloatingHand());
    //     hand.style.order = v == 1 ? 1 : 4;

    //     if (v == 3) {
    //       this.openHand();
    //     }
    //   }

    //   this.ensureNoSortableHandOnTouchDevice();
    // },

    updateHandCards() {
      return; // TODO
      if (this.isSpectator) return;
      this.empty(`hand-${this.player_id}`);
      let hand = this.gamedatas.players[this.player_id].hand;
      hand.forEach((card) => {
        this.addZooCard(card);
      });

      this.empty(`scoring-hand-${this.player_id}`);
      let scoringHand = this.gamedatas.players[this.player_id].scoringHand;
      scoringHand.forEach((card) => {
        this.addZooCard(card);
      });
    },

    tplPlayerBoard(player) {
      let above = player.order == 0 ? '' : 'above';
      return `<div class='altered-player-board-resizable ${above}' id='player-board-resizable-${player.id}'>
        <div class='player-board-top'>
          <div class='player-board-alterer' id='board-alterateur-${player.id}'></div>
          <div class='player-board-storm' id='board-storm-${player.id}'>Storm</div>
        </div>
        <div class='player-board-middle'>
          <div class='player-board-memory' id='board-memory-${player.id}'>Memory</div>
          <div class='player-board-permanents' id='board-permanents-${player.id}'>Permanents</div>
        </div>
      </div>`;
    },

    tplPlayerPanel(player) {
      return `<div class='player-info'></div>`;
    },

    notif_setupPlayers(n) {
      debug('Notif: setupPlayers TODOOOO', n);
    },

    ////////////////////////////////////////////////////
    //   ____                  _
    //  / ___|___  _   _ _ __ | |_ ___ _ __ ___
    // | |   / _ \| | | | '_ \| __/ _ \ '__/ __|
    // | |__| (_) | |_| | | | | ||  __/ |  \__ \
    //  \____\___/ \__,_|_| |_|\__\___|_|  |___/
    //
    ////////////////////////////////////////////////////
    /**
     * Create all the counters for player panels
     */
    setupPlayersCounters() {
      return; // TODO
      this._playerCounters = {};
      this._playerCountersMeeples = {};
      this._scoreCounters = {};
      this.forEachPlayer((player) => {
        this._playerCounters[player.id] = {};
        this._playerCountersMeeples[player.id] = {};
        ALL_PLAYER_COUNTERS.forEach((res) => {
          let v = player[res];
          this._playerCounters[player.id][res] = this.createCounter(`counter-${player.id}-${res}`, v);

          if (COUNTER_MEEPLES.includes(res)) {
            this._playerCountersMeeples[player.id][res] = this.addMeeple({
              id: `${res}-${player.id}`,
              pId: player.id,
              type: 'cylinder',
              location: `${res}_${v}`,
            });
          }
        });
        this._scoreCounters[player.id] = this.createCounter('player_new_score_' + player.id, player.newScore);

        // DUPLICATED CYLINDER FOR CONSERVATION
        this._playerCountersMeeples[player.id]['conservation-duplicate'] = this.addMeeple({
          id: `conservation-duplicate-${player.id}`,
          pId: player.id,
          type: 'cylinder',
          location: `conservation-duplicate_${player.conservation}`,
        });

        // Worker counter
        if ($(`counter-${player.id}-worker`)) {
          this._playerCounters[player.id]['worker'] = this.createCounter(`counter-${player.id}-worker`, 0);
        }
      });
      this.updatePlayersCounters(false);
    },

    /**
     * Update all the counters in player panels according to gamedatas, useful for reloading
     */
    updatePlayersCounters(anim = true) {
      return; // TODO

      this.forEachPlayer((player) => {
        PLAYER_COUNTERS.forEach((res) => {
          let value = player[res];
          this._playerCounters[player.id][res].goTo(value, anim);

          // Slide meeples
          if (COUNTER_MEEPLES.includes(res)) {
            let meeple = this._playerCountersMeeples[player.id][res];
            let container = this.getMeepleContainer({ location: `${res}_${value}`, pId: player.id });
            if (meeple.parentNode != container) {
              if (anim) {
                this.slide(meeple, container);
              } else {
                dojo.place(meeple, container);
              }
            }

            // DUPLICATED CONSERVATION
            if (res == 'conservation') {
              meeple = this._playerCountersMeeples[player.id]['conservation-duplicate'];
              container = this.getMeepleContainer({ location: `conservation-duplicate_${value}`, pId: player.id });
              if (meeple.parentNode != container) {
                if (anim) {
                  this.slide(meeple, container);
                } else {
                  dojo.place(meeple, container);
                }
              }
            }
          }
        });
      });

      this.updateWorkerCounters(anim);
      this.updateDuplicateConservationBoard();
      this.updatePlayersIconsSummaries();
    },

    /**
     * Use this tpl for any counters that represent qty of meeples in "reserve", eg xtokens
     */
    tplResourceCounter(player, res, prefix = '') {
      return this.formatString(`
          <div class='player-resource resource-${res}'>
            <span id='${prefix}counter-${player.id}-${res}' 
              class='${prefix}resource-${res}'></span>${this.formatIcon(res)}
            <div class='reserve' id='${prefix}reserve-${player.id}-${res}'></div>
          </div>
        `);
    },

    /**
     * Animate a player counter receiving/loosing stuff
     */
    animatePlayerCounter(pId, type, n) {
      let oldVal = +this._playerCounters[pId][type].getValue();
      let newVal = oldVal + n;
      if (type == 'reputation' && newVal > 15) newVal = 15;
      if (type == 'xtoken' && newVal > 5) newVal = 5;
      if (oldVal == newVal) {
        return Promise.resolve();
      }

      let meeple = null,
        container = null;
      if (COUNTER_MEEPLES.includes(type)) {
        meeple = this._playerCountersMeeples[pId][type];
        container = this.getMeepleContainer({
          pId,
          type,
          location: `${type}_${newVal}`,
        });
      }

      if (this.isFastMode()) {
        this._playerCounters[pId][type].incValue(n);
        if (meeple !== null) {
          $(container).insertAdjacentElement('beforeend', meeple);

          if (type == 'conservation') {
            meeple = this._playerCountersMeeples[pId]['conservation-duplicate'];
            container = this.getMeepleContainer({ location: `conservation-duplicate_${newVal}`, pId });
            $(container).insertAdjacentElement('beforeend', meeple);
            this.updateDuplicateConservationBoard();
          }
        }
        return Promise.resolve();
      }

      let tmpElt = `<div style='position:absolute' id='animation-${type}'>${this.formatIcon(type, Math.abs(n))}</div>`;
      this.getVisibleTitleContainer().insertAdjacentHTML('beforebegin', tmpElt);
      let mobileId = `animation-${type}`;
      let counterId = `counter-${pId}-${type}`;

      if (meeple !== null) {
        this.slide(meeple, container);

        // DUPLICATE CONSERVATION
        if (type == 'conservation') {
          meeple = this._playerCountersMeeples[pId]['conservation-duplicate'];
          container = this.getMeepleContainer({ location: `conservation-duplicate_${newVal}`, pId });
          this.slide(meeple, container);
        }
      }

      if (n < 0) {
        // Loosing stuff
        this._playerCounters[pId][type].incValue(n);
        return this.slide(mobileId, this.getVisibleTitleContainer(), {
          from: counterId,
          destroy: true,
          phantom: false,
          duration: 1200,
        });
      } else {
        // Gaining stuff
        return this.slide(mobileId, counterId, {
          from: this.getVisibleTitleContainer(),
          destroy: true,
          phantom: false,
          duration: 1200,
        }).then(() => {
          this._playerCounters[pId][type].incValue(n);
          if (type == 'conservation') this.updateDuplicateConservationBoard();
        });
      }
    },

    notif_getBonuses(n) {
      debug('Notif: getting bonus/gaining resources', n);
      // Update counters promises
      let counters = Object.keys(n.args.bonuses);
      let promises = counters.map((type) => {
        if (type == 'source') return;

        let amount = n.args.bonuses[type];
        return this.animatePlayerCounter(n.args.player_id, type, amount);
      });

      // Callback
      Promise.all(promises).then(() => {
        if (n.args.score) {
          this._scoreCounters[n.args.player_id].toValue(n.args.score);
        }
        if (n.args.income) {
          this._playerCounters[n.args.player_id]['income'].toValue(n.args.income);
        }
        this.notifqueue.setSynchronousDuration(this.isFastMode() ? 0 : 100);
      });
    },

    notif_payMana(n) {
      debug('Notif: paying mana', n);
      // TOOD
    },

    notif_moveStormToken(n) {
      debug('Notif : moving storm token', n);
      // TODO
    },

    notif_newFirstPlayer(n) {
      debug('Notif : change of first player', n);
      // TODO
    },
  });
});
