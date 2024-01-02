define(['dojo', 'dojo/_base/declare'], (dojo, declare) => {
  const PLAYER_COUNTERS = ['mana', 'totalMana', 'handCount', 'deckCount'];

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

    getOpponent(pId) {
      return this.orderedPlayers[0].id == pId ? this.orderedPlayers[1].id : this.orderedPlayers[0].id;
    },

    setupPlayers() {
      // Change No so that it fits the current player order view
      let currentNo = this.getPlayers().reduce((carry, player) => (player.id == this.player_id ? player.no : carry), 0);
      let nPlayers = Object.keys(this.gamedatas.players).length;
      this.forEachPlayer((player) => (player.order = (player.no + nPlayers - currentNo) % nPlayers));
      this.orderedPlayers = Object.values(this.gamedatas.players).sort((a, b) => a.order - b.order);
      this.bottomPId = this.orderedPlayers[0].id;
      this.topPId = this.orderedPlayers[1].id;
      this._discardModals = {};

      // Add player board and player panel
      this.orderedPlayers.forEach((player, i) => {
        let container = i == 0 ? 'altered-board-me' : 'altered-board-opponent';
        this.place('tplPlayerBoard', player, container);

        // Panels
        this.place('tplPlayerPanel', player, `overall_player_board_${player.id}`);

        // Discard modal
        this.setupDiscardModal(player);
        // Mana modal
        if (player.id == this.player_id) {
          this.setupManaModal(player);
        }
      });

      this.setupPlayersCounters();
      // TODO : remove at some point
      if ($('open-all-cards-modal')) $('open-all-cards-modal').addEventListener('click', () => this.openAllCardsModal());
    },

    onChangeHandLocationSetting(v) {
      let hand = $(`hand-${this.player_id}`);
      if (hand) {
        let container = this.isFloatingHand() ? 'floating-hand' : `player-board-hand-${this.player_id}`;
        $(container).insertAdjacentElement('beforeend', hand);
        $('floating-hand-wrapper').classList.toggle('active', this.isFloatingHand());
        hand.style.order = v == 1 ? 1 : 4;

        if (v == 3) {
          this.openHand();
        }
      }

      // this.ensureNoSortableHandOnTouchDevice();
    },

    // updateHandCards() {
    //   if (this.isSpectator) return;
    //   this.empty(`hand-${this.player_id}`);
    //   let hand = this.gamedatas.players[this.player_id].hand;
    //   hand.forEach((card) => {
    //     this.addCard(card);
    //   });
    // },

    tplPlayerBoard(player) {
      let pId = player.id;
      return `<div class='altered-player-board' id='player-board-${pId}' data-faction='${player.faction}'>
          <div class='player-board-discard' id='board-discard-${player.id}'></div>
          <div class='player-board-deck' id='board-deck-${player.id}'>
            <div class='deck-counter-holder'>
              <div class='deck-counter' id="counter-${player.id}-deckCount"></div>
            </div>
          </div>
          <div class='player-board-grass'>
            <div class='player-board-reserve' id='board-reserve-${player.id}'></div>
            <div class='player-board-limbo' id='board-limbo-${player.id}'></div>
            <div class='player-board-separator'></div>
            <div class='player-board-landmarks' id='board-landmark-${player.id}'></div>
          </div>

          <div class='player-board-mana-wrapper'>
            <div class='player-board-mana-gauge' id='mana-gauge-${pId}'></div>
            <div class='player-board-mana-indicator'>
              <h6>${this.formatIcon('first-player')} ${_('MANA')}</h6>
              <div class='mana-counters-wrapper'>
                <span class="mana-counter" id="counter-board-${pId}-mana"></span> 
                / 
                <span class="mana-counter" id="counter-board-${pId}-totalMana"></span>
              </div>
            </div>
          </div>

          <div class='player-board-storm storm-left' id='board-stormLeft-${pId}'>
            <div class="total-biomes">
              <div class='total-forest'></div>
              <div class='total-mountain'></div>
              <div class='total-ocean'></div>
              <div class='total-biomes-highlights'>
                <div class='total-forest-highlight'></div>
                <div class='total-mountain-highlight'></div>
                <div class='total-ocean-highlight'></div>
              </div>
            </div>
          </div>
          <div class='player-board-hero' id='board-hero-${pId}'>
            <div class="altered-first-player-holder" id="firstPlayer-${player.id}"></div>
          </div>
          <div class='player-board-storm storm-right' id='board-stormRight-${pId}'>
            <div class="total-biomes">
              <div class='total-forest'></div>
              <div class='total-mountain'></div>
              <div class='total-ocean'></div>
              <div class='total-biomes-highlights'>
                <div class='total-forest-highlight'></div>
                <div class='total-mountain-highlight'></div>
                <div class='total-ocean-highlight'></div>
              </div>
            </div>
          </div>

          <div class='player-board-hand' id='player-board-hand-${pId}'>
            <div class='player-hand' id='hand-${player.id}'></div>
          </div>
        </div>`;
    },

    tplPlayerPanel(player) {
      return (
        `
      <div class='player-info'>
        <div class='mana-counter-holder'>
          <span class="mana-counter" id="counter-${player.id}-mana"></span>/<span class="mana-counter" id="counter-${player.id}-totalMana"></span>
          <span class="player-mana-icon">MANA</span>
        </div>

        <div class='handCount-holder'>
          <span class="player-handCount" id="counter-${player.id}-handCount"></span>
          <span class="player-handCount-icon">HAND</span>
        </div>
      </div>` + (player.id == this.player_id ? `<div id='open-all-cards-modal'>Show all cards</div>` : '')
      );
    },

    notif_setupPlayer(n) {
      debug('Notif: setupPlayer', n);
      let pId = n.args.player_id;

      // Update faction
      let faction = n.args.faction;
      this.gamedatas.players[pId].faction = faction;
      $(`player-board-${pId}`).setAttribute('data-faction', faction);

      // Slide hero
      let hero = n.args.card;
      this.addCard(hero, `hand-${pId}`);
      // if (!$(`card-${hero.id}`)) {
      // this.addCard(hero, `hand-${pId}`);
      // } else if ($('overlay-deck-container')) {
      //   // [...$('overlay-deck-container').querySelectorAll('.altered-card')].forEach((oCard) => {
      //   //   if (oCard.dataset.id != hero.id) oCard.classList.add('phantom');
      //   // });
      // }

      this.slide(`card-${hero.id}`, `board-hero-${pId}`).then(() => {
        n.args.meeples.forEach((meeple) => {
          this.addMeeple(meeple, `card-${hero.id}`);
          debug(this.getMeepleContainer(meeple));
          this.slide(`meeple-${meeple.id}`, this.getMeepleContainer(meeple));
        });
      });

      // Deck count
      this._playerCounters[pId]['deckCount'].toValue(n.args.deckCount);
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
      this._playerCounters = {};
      // this._playerCountersMeeples = {};
      this.forEachPlayer((player) => {
        let pId = player.id;
        let c = {};

        // MANA
        c.totalMana = this.createCounter([`counter-${pId}-totalMana`, `counter-board-${pId}-totalMana`], player.totalMana, (v) =>
          this.onUpdateTotalManaCounter(pId, v)
        );
        c.mana = this.createCounter([`counter-${pId}-mana`, `counter-board-${pId}-mana`], player.mana, (v) =>
          this.onUpdateManaCounter(pId, v)
        );

        // HAND
        c.handCount = this.createCounter([`counter-${pId}-handCount`], player.handCount, (v) =>
          this.onUpdateHandCountCounter(pId, v)
        );

        // DECK COUNT
        c.deckCount = this.createCounter([`counter-${pId}-deckCount`], player.deckCount);

        this._playerCounters[pId] = c;
      });
    },

    /**
     * Update all the counters in player panels according to gamedatas, useful for reloading
     */
    updatePlayersCounters(anim = true) {
      this.forEachPlayer((player) => {
        PLAYER_COUNTERS.forEach((res) => {
          let value = player[res];
          this._playerCounters[player.id][res].goTo(value, anim);
        });

        this.updateBiomeTotals(player.id);
      });
      this.updateMovements();
      this.updatePassedPlayers();
    },

    onUpdateManaCounter(pId, v) {
      let container = $(`mana-gauge-${pId}`);
      [...container.querySelectorAll('.mana-gauge-slot')].forEach((slot, i) => slot.classList.toggle('available', i < v));
    },

    onUpdateTotalManaCounter(pId, v) {
      let container = $(`mana-gauge-${pId}`);
      let slots = [...container.querySelectorAll('.mana-gauge-slot')];
      for (let i = slots.length; i < v; i++) {
        container.insertAdjacentHTML('beforeend', `<div class='mana-gauge-slot'><div class='mana-gem'></div></div>`);
      }
    },
    onUpdateHandCountCounter(pId, v) {
      if (pId == this.player_id) return;
      let container = $(`hand-${pId}`);
      let cards = [...container.querySelectorAll('.altered-card')];
      for (let i = cards.length; i < v; i++) {
        this.addFakeCard(container);
      }
    },

    updateBiomeTotals(pId, biomes = null) {
      if (biomes !== null) {
        this.gamedatas.players[pId].biomes = biomes;
      }

      let opponentId = this.getOpponent(pId);

      // Update the total for each biome and each side
      ['stormLeft', 'stormRight'].forEach((storm) => {
        let container = $(`board-${storm}-${pId}`);
        p = this.gamedatas.players[pId].biomes[storm];

        // Update
        let sizes = this.getBiomesUISizes(p);
        ['forest', 'mountain', 'ocean'].forEach((biome) => {
          let o = container.querySelector(`.total-${biome}`);
          o.innerHTML = p[biome];
          o.dataset.size = sizes[biome];

          // // Compare them
          // let o2 = $(`board-${storm}-${opponentId}`).querySelector(`.total-${biome}`);
          // let v2 = this.gamedatas.players[opponentId].biomes[storm][biome];
          // if (p[biome] < v2) {
          //   o.classList.remove('bigger');
          //   o2.classList.add('bigger');
          // } else if (p[biome] > v2) {
          //   o.classList.add('bigger');
          //   o2.classList.remove('bigger');
          // } else {
          //   o.classList.remove('bigger');
          //   o2.classList.remove('bigger');
          // }
        });
      });
    },

    updateMovements(movements = null) {
      if (movements !== null) {
        this.gamedatas.movements = movements;
      }

      let willMove = {};

      this.forEachPlayer((player) => {
        let pId = player.id;
        willMove[pId] = {};

        // Update will move for each biome
        ['hero', 'companion'].forEach((type) => {
          let stormSide = type == 'hero' ? 'stormLeft' : 'stormRight';
          let container = $(`board-${stormSide}-${pId}`);

          let moving = false;
          ['forest', 'mountain', 'ocean'].forEach((biome) => {
            let o = container.querySelector(`.total-${biome}`);
            o.dataset.willProgress = this.gamedatas.movements[pId][type][biome];
            if (o.dataset.willProgress == 2) moving = true;
          });

          willMove[pId][type] = moving;
        });
      });

      console.log(willMove);

      let minPos = 8,
        maxPos = 0;
      [...$('storm-container').querySelectorAll('.altered-meeple')].forEach((meeple) => {
        let pId = meeple.dataset.side == 'opponent' ? this.topPId : this.bottomPId;
        let type = meeple.dataset.type;
        let willProgress = willMove[pId][type];
        meeple.classList.toggle('willProgress', willProgress);

        let pos = +meeple.parentNode.dataset.x;
        if (type == 'hero') minPos = Math.min(minPos, pos);
        else maxPos = Math.max(maxPos, pos);
      });

      let minCard = Math.floor((minPos + 1) / 2),
        maxCard = Math.floor((maxPos + 1) / 2);
      for (let i = 0; i < 5; i++) {
        $(`storm-card-container-${i}`).classList.toggle('useless', i < minCard || i > maxCard);
      }
    },

    notif_updateBiomes(n) {
      debug('Notif: updating biomes', n);
      this.updateBiomeTotals(n.args.pId, n.args.biomes);
      this.updateMovements(n.args.movements);
    },

    updatePassedPlayers(pId = null) {
      if (pId !== null) {
        this.gamedatas.passedPlayers.push(pId);
      }

      let skipped = this.gamedatas.passedPlayers;
      $('focus-storm-overlay').classList.toggle('mePassed', skipped.includes(this.bottomPId));
      $('focus-storm-overlay').classList.toggle('opponentPassed', skipped.includes(this.topPId));
    },

    notif_passTurn(n) {
      debug('Notif: someone is over', n);
      this.updatePassedPlayers(n.args.player_id);
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

    notif_afterYou(n) {
      debug('Notif: after you passing', n);
      // Update counters
      this._playerCounters[n.args.player_id]['mana'].toValue(n.args.mana);
      this._playerCounters[n.args.player_id]['totalMana'].toValue(n.args.totalMana);
    },

    notif_roll(n) {
      debug('Notif: rolling dice', n);
      // TODO
    },

    notif_pay(n) {
      debug('Notif: pay', n);
      this._playerCounters[n.args.player_id]['mana'].toValue(n.args.mana);
      this._playerCounters[n.args.player_id]['totalMana'].toValue(n.args.totalMana);
    },
  });
});
