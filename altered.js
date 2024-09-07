/**
 *------
 * BGA framework: © Gregory Isabelli <gisabelli@boardgamearena.com> & Emmanuel Colin <ecolin@boardgamearena.com>
 * Altered implementation : © <Your name here> <Your email address here>
 *
 * This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
 * See http://en.boardgamearena.com/#!doc/Studio for more information.
 * -----
 *
 * altered.js
 *
 * Altered user interface script
 *
 * In this file, you are describing the logic of your user interface, in Javascript language.
 *
 */

var isDebug = window.location.host == 'studio.boardgamearena.com' || window.location.hash.indexOf('debug') > -1;
var debug = isDebug ? console.info.bind(window.console) : function () {};

define([
  'dojo',
  'dojo/_base/declare',
  g_gamethemeurl + 'modules/js/vendor/sortable.min.js',
  'ebg/core/gamegui',
  'ebg/counter',
  g_gamethemeurl + 'modules/js/Core/game.js',
  g_gamethemeurl + 'modules/js/Core/modal.js',
  g_gamethemeurl + 'modules/js/Players.js',
  g_gamethemeurl + 'modules/js/Cards.js',
  g_gamethemeurl + 'modules/js/Meeples.js',
], function (dojo, declare, Sortable) {
  function openFullscreen() {
    var docElm = document.documentElement;
    if (docElm.requestFullscreen) {
      docElm.requestFullscreen();
    } else if (docElm.mozRequestFullScreen) {
      docElm.mozRequestFullScreen();
    } else if (docElm.webkitRequestFullScreen) {
      docElm.webkitRequestFullScreen();
    } else if (docElm.msRequestFullscreen) {
      docElm.msRequestFullscreen();
    }
  }

  function closeFullscreen() {
    if (document.exitFullscreen) {
      document.exitFullscreen();
    } else if (document.webkitExitFullscreen) {
      document.webkitExitFullscreen();
    } else if (document.mozCancelFullScreen) {
      document.mozCancelFullScreen();
    } else if (document.msExitFullscreen) {
      document.msExitFullscreen();
    }
  }

  return declare('bgagame.altered', [customgame.game, altered.players, altered.cards, altered.meeples], {
    constructor: function () {
      this._inactiveStates = ['selectPrecoDeck', 'firstDayManaSelection', 'newDayManaSelection', 'gameEnd'];
      this._notifications = [
        ['updateInformations', 10],
        ['mediumMessage', 1000],
        ['midMessage', 1200],
        ['clearTurn', 200],
        ['refreshUI', 200],
        ['refreshHand', 200],
        ['updateInitialPrecoDeckSelection', 200],
        ['vsScreen', 100],
        ['setupPlayer', 3000],
        ['updateFirstDayManaSelection', 200],
        ['nightCleanup', null],
        ['cleanupCards', null],
        ['newFirstPlayer', null],
        ['startDusk', 1200],
        ['endDusk', 900],
        ['passTurn', 800],

        ['addMeeples', null],
        ['looseMeeples', null],

        ['pDrawCards', null],
        ['drawCards', null, (notif) => notif.args.player_id == this.player_id],
        ['publicDrawCards', null],
        ['pDiscardCards', null],
        ['publicDiscard', null],
        ['discardCards', null, (notif) => notif.args.player_id == this.player_id],
        // ['discardCardsOnDisplay', null],
        ['playCard', null],
        ['supportEffect', null],
        ['moveStormToken', null],
        ['moveToHand', null],
        ['silentKill', 200],
        ['spellCleanup', null],
        ['invokeToken', null],
        ['afterYou', 1000],
        ['pay', 100],
        ['gainCounter', 1400],
        ['useCounter', 1400],
        ['deleteCounter', 500],
        ['shuffleDeck', 100],
        ['winTieBreaker', 50],
        ['startTiebreak', null],
        ['targetCards', 500],
        ['moveCard', null],
        ['newPhase', 1000],
        ['putOnDeck', null],

        ['tap', 800],
        ['untap', 500],
        ['updateTotalMana', 200],
        ['roll', 3000],

        // TODO??
        ['blockAllExpeditions', 100],
      ];

      // Fix mobile viewport (remove CSS zoom)
      this.default_viewport = 'width=1000';
      this.biggestHeightLandscape = 0;
      this.cardStatuses = {};

      this._loadingComplete = false;
      this._fakeIndex = -1;
      this._diceIndex = 1;
      this._undoPossible = true;
      this._beginner = false;
    },
    notif_midMessage(n) {},

    getSettingsSections() {
      return {
        layout: _('Layout'),
        //        playerBoard: _('Player Board/Panel'),
        gameFlow: _('Game Flow'),
        //        other: _('Other'),
      };
    },

    getSettingsConfig() {
      return {
        ////////////////////
        ///    LAYOUT    ///
        boardHeight: {
          default: 100,
          name: _('Board height'),
          type: 'slider',
          sliderConfig: {
            step: 3,
            padding: 0,
            range: {
              min: [80],
              max: [120],
            },
          },
          section: 'layout',
        },
        fitTo: {
          default: (isMobile, isTouchDevice) => (isTouchDevice ? 1 : 0),
          name: _('Lock mode fitting direction'),
          type: 'select',
          values: {
            0: _('Fit to height'),
            1: _('Fit to width'),
          },
          section: 'layout',
        },

        // handLocation: {
        //   default: (isMobile, isTouchDevice) => (isTouchDevice ? 1 : 3),
        //   name: _('Hand of cards'),
        //   type: 'select',
        //   values: {
        //     0: _('On the board'),
        //     1: _('In a floating collapsible container'),
        //     2: _('In a floating collapsible container, opened when entering the table'),
        //   },
        //   section: 'layout',
        // },
        // cardScale: {
        //   default: 40,
        //   name: _('Card size in hand'),
        //   type: 'slider',
        //   sliderConfig: {
        //     step: 3,
        //     padding: 0,
        //     range: {
        //       min: [30],
        //       max: [80],
        //     },
        //   },
        //   section: 'layout',
        // },

        //////////////////////
        /// BOARD / PANELS ///

        //////////////////////
        ///// GAME FLOW //////
        confirmMode: { type: 'pref', prefId: 103, section: 'gameFlow' },
        confirmUndoableMode: { type: 'pref', prefId: 104, section: 'gameFlow' },
        restartButtons: {
          default: 1,
          name: _('Restart turn buttons'),
          type: 'select',
          attribute: 'undoButtons',
          values: {
            0: _('Only "Restart turn" button'),
            1: _('"Restart turn" and "Undo last step" buttons'),
            2: _('Only "Undo last step" button'),
          },
          section: 'gameFlow',
        },
        playerUndo: { type: 'pref', prefId: 152, section: 'gameFlow' },

        //////////////////////
        /////// OTHER ////////
        // sortableHand: {
        //   default: (isMobile, isTouchDevice) => (isTouchDevice ? 1 : 0),
        //   name: _('Sortable hand using dragndrop'),
        //   type: 'select',
        //   values: {
        //     0: _('Enabled'),
        //     1: _('Disabled'),
        //   },
        //   section: 'other',
        // },
      };
    },

    isFloatingHand() {
      return [1, 2].includes(parseInt(this.settings.handLocation));
    },

    openHand() {
      if (this.isFloatingHand()) {
        $('floating-hand-wrapper').dataset.open = 'hand';
      }
    },

    onLeavingFastMode() {
      this.updateLayout();

      this.orderedPlayers.forEach((player, i) => {
        let handContainer = $(`hand-${player.id}`);
        this.adjustHand(handContainer, i == 0 ? 'bottom' : 'top');

        if (player.id == this.player_id) {
          this.clearHandTransform($(`mana-cards-${player.id}`));
        }
        this.clearHandTransform($(`board-discard-${player.id}`));
        this.clearHandTransform($(`board-reserve-${player.id}`));
        this.clearHandTransform($(`board-landmark-${player.id}`));
      });
    },

    notif_updateInformations(n) {
      debug('Notif: updating some informations', n);
      // Biome totals
      if (n.args.biomes !== undefined) {
        this.gamedatas.biomes = n.args.biomes;
        this.updateBiomeTotals();
      }
      // Will move
      if (n.args.movements !== undefined) {
        this.gamedatas.movements = n.args.movements;
        this.updateMovements();
      }
      // Blocked expedition
      if (n.args.blockedExpeditions !== undefined) {
        this.gamedatas.blockedExpeditions = n.args.blockedExpeditions;
        this.updateBlockedExpeditions();
      }
      // Powers-blocked expeditions
      if (n.args.powersBlockedExpeditions !== undefined) {
        this.gamedatas.powersBlockedExpeditions = n.args.powersBlockedExpeditions;
        this.updatePowersBlockedExpeditions();
      }
      // Defenders
      if (n.args.defenders !== undefined) {
        this.gamedatas.defenders = n.args.defenders;
        this.updateDefenders();
      }
    },

    /**
     * Setup:
     *	This method set up the game user interface according to current game situation specified in parameters
     *	The method is called each time the game interface is displayed to a player, ie: when the game starts and when a player refreshes the game page (F5)
     *
     * Params :
     *	- mixed gamedatas : contains all datas retrieved by the getAllDatas PHP method.
     */
    setup(gamedatas) {
      debug('SETUP', gamedatas);
      // Create a new div for "anytime" buttons
      dojo.place("<div id='anytimeActions' style='display:inline-block;float:right'></div>", $('generalactions'), 'after');
      // Create a new div for "subtitle"
      dojo.place("<div id='pagesubtitle'></div>", 'maintitlebar_content');
      // Create a new div for overlays
      $('left-side-wrapper').insertAdjacentHTML('beforeend', '<div id="altered-overlay"></div>');
      // Create a new div for storm overlays
      $('left-side-wrapper').insertAdjacentHTML(
        'beforeend',
        `<div id="focus-storm-overlay">
          <div id="focus-storm-top"></div>
          <div id="focus-storm-middle"></div>
          <div id="focus-storm-bottom"></div>          
        </div>`
      );
      $('day-indicator-wheel-inner').dataset.phase = gamedatas.phase;

      // Experimental
      $('altered-main-container').insertAdjacentElement('beforeend', $('page-title'));
      $('left-side').insertAdjacentHTML(
        'beforeend',
        `<div id="bga-help_buttons">
          <button id="toggle-focus-mode" class="bga-help_button"></button>
        </div>`
      );

      $('toggle-focus-mode').addEventListener('click', () => {
        document.body.classList.toggle('focus-board');
        if (document.body.classList.contains('focus-board')) {
          window.scrollTo(0, 0);
          this.biggestHeightLandscape = 0;
          // openFullscreen();
        } else {
          // closeFullscreen();
        }
        this.onGameUiWidthChange();
      });

      this.setupInfoPanel();
      this.setupBoard();
      this.setupPlayers();
      this.setupCards();
      this.setupMeeples();
      // this.setupOAuth();
      // this.setupSortableHand();

      // Updatable informations
      this.updateBiomeTotals();
      this.updateMovements();
      this.updateBlockedExpeditions();
      this.updatePowersBlockedExpeditions();
      this.updateDefenders();
      this._undoPossible = gamedatas.undo;
      this._beginner = gamedatas.beginner;

      this.inherited(arguments);
    },

    openOverlay() {
      $('altered-overlay').classList.add('active');
      $('altered-board-overlay').classList.add('active');
      this.centerOverlay();
    },
    closeOverlay() {
      this.closeCurrentTooltip(false);
      $('altered-overlay').classList.remove('active');
      $('altered-board-overlay').classList.remove('active');
    },
    centerOverlay() {
      let h = $('page-title').getBoundingClientRect()['height'];
      $('altered-board-overlay').style.paddingTop = h + 'px';
    },

    addToggleOverlayButton() {
      let getText = () => ($('altered-overlay').classList.contains('active') ? _('Close overlay') : _('Open overlay'));

      this.addSecondaryActionButton('btnToggleOverlay', getText(), () => {
        $('altered-overlay').classList.toggle('active');
        $('altered-board-overlay').classList.toggle('active');
        $('btnToggleOverlay').innerHTML = getText();
      });
    },

    closeOverlayIfOpened() {
      this.closeOverlay();
      this.onChangeHandLocationSetting();
      $('altered-overlay-content').innerHTML = '';
    },

    setupSortableHand() {
      // TODO
      // if ($(`hand-${this.player_id}`)) {
      //   let that = this;
      //   this._sortableHand = Sortable.create($(`hand-${this.player_id}`), {
      //     onStart(evt) {
      //       let cardId = evt.item.id;
      //       let tooltip = that.tooltips[cardId];
      //       tooltip.close();
      //       if (tooltip.showTimeout != null) clearTimeout(tooltip.showTimeout);
      //       that._dragndropMode = true;
      //     },
      //     onEnd(evt) {
      //       that._dragndropMode = false;
      //       let cardIds = that._sortableHand.toArray();
      //       that.takeAction('actOrderCards', { cardIds: JSON.stringify(cardIds), lock: false }, false);
      //     },
      //     fallbackTolerance: 10,
      //     delay: 200,
      //     delayOnTouchOnly: true,
      //     touchStartThreshold: 10,
      //   });
      // }
    },

    /*
     * Create form to request access token from Google's OAuth 2.0 server.
     */
    setupOAuth() {
      // Google's OAuth 2.0 endpoint for requesting an access token
      let oauth2Endpoint = 'https://accounts.google.com/o/oauth2/v2/auth';

      // Create <form> element to submit parameters to OAuth 2.0 endpoint.
      let form = document.createElement('form');
      form.setAttribute('method', 'GET'); // Send as a GET request.
      form.setAttribute('action', oauth2Endpoint);

      // Parameters to pass to OAuth 2.0 endpoint.
      let params = {
        project_id: 'bga-altered',
        client_id: '516885558184-6amd2b1sma940uh2o7p3fbqocoh3qfkd.apps.googleusercontent.com',
        redirect_uri: 'https://localhost/index.php',
        response_type: 'code',
        scope: 'https://www.googleapis.com/auth/drive.metadata.readonly',
        include_granted_scopes: 'true',
        state: 'pass-through value',
      };

      let URL = oauth2Endpoint + '?';
      let urlParams = [];
      // Add form parameters as hidden input values.
      for (var p in params) {
        // var input = document.createElement('input');
        // input.setAttribute('type', 'hidden');
        // input.setAttribute('name', p);
        // input.setAttribute('value', params[p]);
        // form.appendChild(input);
        urlParams.push(p + '=' + params[p]);
      }

      let btn = document.createElement('a');
      btn.href = URL + urlParams.join('&');
      btn.target = '_blank';

      // let btn = document.createElement('button');
      btn.setAttribute('type', 'submit');
      btn.appendChild(document.createTextNode('OAuth'));
      btn.classList.add('bgabutton');
      btn.classList.add('bgabutton_red');
      // btn.style.position = 'absolute';
      // btn.style.top = '50%';
      // btn.style.left = '0px';
      btn.style.width = '100px';
      btn.style.zIndex = 1000;
      btn.style.fontSize = '20px';
      form.appendChild(btn);

      // Add form to page and submit it to open the OAuth 2.0 endpoint.
      // $('altered-board').appendChild(form);
      $('anytimeActions').appendChild(form);

      //      form.submit();
    },

    setupBoard() {
      let storm = this.gamedatas.storm;
      storm.forEach((stormCard, i) => {
        if (this.gamedatas.tieBreaker && i == 2) stormCard.cardId = 5;

        $('storm-container').insertAdjacentHTML(
          'beforeend',
          `<div class='storm-card-container' id='storm-card-container-${i}'>
            <div class='storm-card' data-id='${stormCard.cardId % 10}' data-flipped='${stormCard.rotated ? 1 : 0}'></div>
          </div>`
        );
      });
      if (this.gamedatas.tieBreaker) {
        $('ebd-body').dataset.tieBreaker = 1;
      }

      for (let i = 0; i < 8; i++) {
        $('storm-container').insertAdjacentHTML(
          'beforeend',
          `<div class='storm-space' id='storm-${i}'>
            <div class='storm-slot' id='storm-${i}-opponent' data-x="${i}"></div>
            <div class='storm-slot' id='storm-${i}-player' data-x="${i}"></div>
          </div>`
        );
      }

      $('storm-container').insertAdjacentHTML('beforeend', '<div id="roll-dice-container"></div>');

      $('day-indicator-frame').insertAdjacentHTML('beforeend', `<div class="storm-text">${_('HERO')}</div>`);
      $('storm-end-frame').insertAdjacentHTML('beforeend', _('COMPANION'));

      $('day-indicator-frame').insertAdjacentHTML(
        'beforeend',
        `<div id='help-phases-button'>
          <svg><use href="#help-marker-svg" /></svg>
        </div>`
      );
      $('help-phases-button').addEventListener('click', () => this.openHelperModal());
    },

    // onChangeSortableHandSetting(v) {
    //   if (this._sortableHand) this._sortableHand.option('disabled', v == 1);

    //   this.ensureNoSortableHandOnTouchDevice();
    // },

    // ensureNoSortableHandOnTouchDevice() {
    //   if (this.isTouchDevice && this.settings && this.settings.sortableHand == 0 && this.isFloatingHand() && this._sortableHand) {
    //     this._sortableHand.option('disabled', true);

    //     this.showMessage(
    //       _(
    //         "Sortable hand with floating hand on touchscreen is disabled because it's buggy on many devices (can't click on card to select them). Sorry for the inconvenience."
    //       ),
    //       'info'
    //     );
    //   }
    // },

    onLoadingComplete() {
      this.updateLayout();
      document.fonts.ready.then(() => {
        document.querySelectorAll('.altered-card').forEach((oCard) => this.autofitCardFrame(oCard, true));
        this._loadingComplete = true;
      });
      this.inherited(arguments);
    },

    onScreenWidthChange() {
      if (this.settings) this.updateLayout();
    },

    onAddingNewUndoableStepToLog(notif) {
      if (!$(`log_${notif.logId}`)) return;
      let stepId = notif.msg.args.stepId;
      $(`log_${notif.logId}`).dataset.step = stepId;
      if ($(`dockedlog_${notif.mobileLogId}`)) $(`dockedlog_${notif.mobileLogId}`).dataset.step = stepId;

      if (
        this.gamedatas &&
        this.gamedatas.gamestate &&
        this.gamedatas.gamestate.args &&
        this.gamedatas.gamestate.args.previousSteps &&
        this.gamedatas.gamestate.args.previousSteps.includes(parseInt(stepId))
      ) {
        this.onClick($(`log_${notif.logId}`), () => this.undoToStep(stepId));

        if ($(`dockedlog_${notif.mobileLogId}`)) this.onClick($(`dockedlog_${notif.mobileLogId}`), () => this.undoToStep(stepId));
      }
    },

    undoToStep(stepId) {
      this.stopActionTimer();
      this.checkAction('actRestart');
      this.takeAction('actUndoToStep', { stepId }, false);
    },

    notif_clearTurn(n) {
      debug('Notif: restarting turn', n);
      this.cancelLogs(n.args.notifIds);
    },

    notif_refreshUI(n) {
      debug('Notif: refreshing UI', n);

      Object.keys(n.args.datas).forEach((value) => {
        this.gamedatas[value] = n.args.datas[value];
      });
      this.setupCards();
      this.setupMeeples();
      this.updatePlayersCounters();
    },

    notif_refreshHand(n) {
      debug('Notif: refreshing UI hand and mana', n);
      let cardIds = [];
      n.args.hand.forEach((card) => {
        if (!$(`card-${card.id}`)) {
          this.addCard(card);
        } else {
          $(`hand-${this.player_id}`).insertAdjacentElement('beforeend', $(`card-${card.id}`));
        }
        cardIds.push(card.id);
      });
      n.args.mana.forEach((card) => {
        if (!$(`card-${card.id}`)) {
          this.addCard(card);
        } else {
          $(`mana-cards-${this.player_id}`).insertAdjacentElement('beforeend', $(`card-${card.id}`));
        }
        cardIds.push(card.id);
      });

      // Destroy other cards
      [
        ...$(`mana-cards-${this.player_id}`).querySelectorAll('.altered-card'),
        ...$(`hand-${this.player_id}`).querySelectorAll('.altered-card'),
      ].forEach((oCard) => {
        if (!cardIds.includes(parseInt(oCard.getAttribute('data-id')))) {
          this.destroy(oCard);
        }
      });
    },

    onUpdateActionButtons(stateName, args) {
      // this.addPrimaryActionButton('test', 'test', () => this.testNotif());
      this.inherited(arguments);
    },

    testNotif() {
      let o = {
        uid: '658b59c2be6d0',
        type: 'vsScreen',
        log: '',
        args: {
          factions: {
            2322020: 'MU',
            2322021: 'BR',
          },
        },
        channelorig: '/table/t545303',
        gamenameorig: 'altered',
        time: 1703631299,
        move_id: 15,
        bIsTableMsg: true,
        table_id: '545303',
      };
      this.notif_vsScreen(o);
    },

    clearPossible() {
      dojo.empty('pagesubtitle');

      dojo.query('.selectedToDiscard').removeClass('selectedToDiscard');
      dojo.query('.selectedToKeep').removeClass('selectedToKeep');

      let toRemove = ['btnLaunchSpell'];
      toRemove.forEach((eltId) => {
        if ($(eltId)) $(eltId).remove();
      });

      if ($('popin_manaDisplay_subtitle')) {
        $('popin_manaDisplay_subtitle').remove();
      }
      this._manaModal.hide();

      this.inherited(arguments);
    },

    onEnteringState(stateName, args) {
      debug('Entering state: ' + stateName, args);
      if (this.isFastMode() && ![].includes(stateName)) return;

      if (args.type == 'activeplayer') {
        let pId1 = args.active_player,
          pId2 = this.getOpponent(pId1);
        $(`board-hero-${pId1}`).classList.add('active');
        $(`board-hero-${pId2}`).classList.remove('active');
      }

      if (args.args && args.args.descSuffix) {
        this.changePageTitle(args.args.descSuffix);
      }

      if (args.args && args.args.optionalAction) {
        let base = args.args.descSuffix ? args.args.descSuffix : '';
        this.changePageTitle(base + 'skippable');
      }

      // if (args.args && args.args.source) {
      //   if (this.gamedatas.gamestate.descriptionmyturn.search('{source}') === -1) {
      //     if (args.args.sourceId) {
      //       let card = this.getCardInfos(args.args.sourceId);
      //       let uid = this.registerCustomTooltip(this.tplCard(card, true));

      //       $('pagemaintitletext').insertAdjacentHTML(
      //         'beforeend',
      //         ` (<span class="ark-log-card-name" id="${uid}">${_(args.args.source)}</span>)`
      //       );
      //       this.attachRegisteredTooltips();
      //     } else {
      //       $('pagemaintitletext').insertAdjacentHTML('beforeend', ` (${_(args.args.source)})`);
      //     }
      //   }
      // }

      if (!this._inactiveStates.includes(stateName) && !this.isCurrentPlayerActive()) return;

      if (args.args && args.args.optionalAction && !args.args.automaticAction) {
        this.addSecondaryActionButton(
          'btnPassAction',
          _('Pass'),
          () => this.takeAction('actPassOptionalAction'),
          'restartAction'
        );
      }

      // Undo last steps
      if (args.args && args.args.previousSteps) {
        args.args.previousSteps.forEach((stepId) => {
          let logEntry = $('logs').querySelector(`.log.notif_newUndoableStep[data-step="${stepId}"]`);
          if (logEntry) this.onClick(logEntry, () => this.undoToStep(stepId));

          logEntry = document.querySelector(`.chatwindowlogs_zone .log.notif_newUndoableStep[data-step="${stepId}"]`);
          if (logEntry) this.onClick(logEntry, () => this.undoToStep(stepId));
        });
      }

      // Restart turn button
      if (
        this._undoPossible &&
        args.args &&
        args.args.previousEngineChoices &&
        args.args.previousEngineChoices >= 1 &&
        !args.args.automaticAction
      ) {
        if (args.args && args.args.previousSteps) {
          let lastStep = Math.max(...args.args.previousSteps);
          if (lastStep > 0)
            this.addDangerActionButton('btnUndoLastStep', _('Undo last step'), () => this.undoToStep(lastStep), 'restartAction');
        }

        // Restart whole turn
        this.addDangerActionButton(
          'btnRestartTurn',
          _('Restart turn'),
          () => {
            this.stopActionTimer();
            this.takeAction('actRestart');
          },
          'restartAction'
        );
      }

      if (this.isCurrentPlayerActive() && args.args) {
        // Anytime buttons
        if (args.args.anytimeActions) {
          args.args.anytimeActions.forEach((action, i) => {
            let msg = action.desc;
            msg = msg.log ? this.fsr(msg.log, msg.args) : _(msg);
            msg = this.formatString(msg);

            this.addPrimaryActionButton(
              'btnAnytimeAction' + i,
              msg,
              () => this.takeAction('actAnytimeAction', { id: i }, false),
              'anytimeActions'
            );
          });
        }
      }

      // Call appropriate method
      var methodName = 'onEnteringState' + stateName.charAt(0).toUpperCase() + stateName.slice(1);
      if (this[methodName] !== undefined) this[methodName](args.args);
    },

    onEnteringStateGameEnd() {
      $('focus-storm-overlay').classList.remove('active');
    },

    notif_winTieBreaker(n) {
      debug('Notif: winning with tiebreaker', n);
      // TODO?
    },

    notif_newPhase(n) {
      debug('Notif: start new phase', n);
      let wheel = $('day-indicator-wheel-inner');
      let newVal = n.args.phaseId;
      let turn = parseInt(+wheel.dataset.phase / 5);
      if (newVal == 0) turn++;
      wheel.dataset.phase = turn * 5 + newVal;

      let angles = [0, -74, -140, -216, -290];
      wheel.style.transform = `rotate(${turn * -360 + angles[newVal]}deg)`;
    },

    notif_mediumMessage(n) {},

    ///////////////////////////////////////////////////////////
    //  ____
    // |  _ \ _ __ ___  ___ ___  ___
    // | |_) | '__/ _ \/ __/ _ \/ __|
    // |  __/| | |  __/ (_| (_) \__ \
    // |_|   |_|  \___|\___\___/|___/
    ///////////////////////////////////////////////////////////

    onEnteringStateSelectPrecoDeck(args) {
      if (!args._private) return;
      let deckNum = args._private.selection;
      if (deckNum == 'API') return;
      if (deckNum == 'random') return;

      const FACTION_NAMES = {
        AX: _('Axiom'),
        BR: _('Bravos'),
        LY: _('Lyra'),
        MU: _('Muna'),
        OD: _('Ordis'),
        YZ: _('Yzmir'),
      };

      const FACTION_DESC = {
        AX:
          _('Sierra "the renowned engineer"') +
          '<br/>' +
          _('Construct powerful machines and let their strength carry you to victory!'),
        BR:
          _('Kojo "the rising star"') +
          '<br/>' +
          _('Summon your firecat Companion to seize the advantage without delay, for only the brave make history!'),
        LY:
          _('Nevenka "the unpredictable"') +
          '<br/>' +
          _("What's better than invoking fate to spice up a game? Are you ready to embrace the whims of destiny?"),
        MU:
          _('Teija "the druidess"') +
          '<br/>' +
          _('Anchor and boost your allies over the long haul and reap the rewards of your good deeds.'),
        OD:
          _('Sigismar "the commander"') +
          '<br/>' +
          _('Take the reins of the Ordis Legion and secure victory through sheer numbers!'),
        YZ:
          _('Akesha "the astute"') +
          '<br/>' +
          _('Let your opponent take the initiative to better thwart their plans, slowly but surely.'),
      };

      let selectedDeck = null;
      let selectDeck = (deck) => {
        if (selectedDeck !== null) {
          $(`card-${selectedDeck.hero.id}`).classList.remove('selected');
          $(`btnSelectDeck${selectedDeck.deckNum}`).classList.remove('selected');
        }
        selectedDeck = deck;
        $(`card-${selectedDeck.hero.id}`).classList.add('selected');
        $(`btnSelectDeck${selectedDeck.deckNum}`).classList.add('selected');

        $(`overlay-deck-details`).innerHTML = '';
        $(`overlay-deck-details`).insertAdjacentHTML(
          'beforeend',
          `<div class='deck-details' data-faction='${deck.faction}'>
          <div class='faction-banner' data-faction='${deck.faction}'></div>
          <h3>${FACTION_NAMES[deck.faction]}</h3>
          <p>
            ${FACTION_DESC[deck.faction]}
          </p>
          <div class='details-footer'></div>
        </div>`
        );

        if (deckNum === null || deckNum != selectedDeck.deckNum) {
          if ($('btnCancel') && deckNum === null) $('btnCancel').remove();
          if ($('btnCancelFooter')) $('btnCancelFooter').remove();

          this.addPrimaryActionButton(
            'btnConfirmFooter',
            _('Confirm'),
            () => this.takeAction('actSelectPrecoDeck', { choice: selectedDeck.deckNum }, false),
            $(`overlay-deck-details`).querySelector('.details-footer')
          );
          this.addPrimaryActionButton('btnConfirm', _('Confirm'), () =>
            this.takeAction('actSelectPrecoDeck', { choice: selectedDeck.deckNum }, false)
          );
        } else {
          if ($('btnConfirm')) $('btnConfirm').remove();
          if ($('btnConfirmFooter')) $('btnConfirm').remove();

          this.addSecondaryActionButton(
            'btnCancelFooter',
            _('Cancel'),
            () => this.takeAction('actCancelPrecoDeckSelection', {}, false),
            $(`overlay-deck-details`).querySelector('.details-footer')
          );
          this.addSecondaryActionButton('btnCancel', _('Cancel'), () =>
            this.takeAction('actCancelPrecoDeckSelection', {}, false)
          );
        }
      };

      decks = args._private.decks;
      decks.forEach((deck) => {
        this.addPrimaryActionButton('btnSelectDeck' + deck.deckNum, FACTION_NAMES[deck.faction], () => selectDeck(deck));
      });

      // Open deck container
      if (!$('overlay-deck-container')) {
        $('altered-overlay-content').innerHTML = '';
        $('altered-overlay-content').insertAdjacentHTML(
          'beforeend',
          `
          <h2>${_('Choose your faction')}</h2>
          <div id='overlay-deck-container'></div>
          <div id='overlay-deck-details'></div>
        `
        );
        decks.forEach((deck) => {
          this.addCard(deck.hero, 'overlay-deck-container');
          $(`card-${deck.hero.id}`).classList.add('no-frame');
        });
      }

      decks.forEach((deck) => {
        this.onClick(`card-${deck.hero.id}`, () => selectDeck(deck));
      });

      this.openOverlay();
      this.addToggleOverlayButton();

      // Already made a selection => allow to cancel it
      let previousCard = $('overlay-deck-container').querySelector('.altered-card.keep');
      if (previousCard) previousCard.classList.remove('keep');
      let previousBtn = $('customActions').querySelector('.bgabutton.keep');
      if (previousBtn) previousBtn.classList.remove('keep');

      if (deckNum != null) {
        $(`btnSelectDeck${deckNum}`).classList.add('keep');
        $(`card-${decks[deckNum].hero.id}`).classList.add('keep');

        selectDeck(args._private.decks[deckNum]);
      }

      // API
      let canUseAPI = !this._beginner;
      if (canUseAPI && !$('card-fake-API')) {
        $('overlay-deck-container').insertAdjacentHTML('beforeend', this.tplFakeCard({ id: 'fake-API' }));
        $('card-fake-API').querySelector('.altered-card-wrapper').insertAdjacentHTML(
          'beforeend',
          `<div style='width:100%; height:100%; display:flex; justify-content:center; align-items:center;'>
            <div style='background: #ffffffe8;padding: 15px;border-radius: 15px;font-size: 37px;border: 4px solid black;box-shadow: 1px 1px 4px black;font-weight: bold;'>
              Custom deck
            </div>
          </div>`
        );
        this.onClick('card-fake-API', () => this.clientState('fetchDecks', 'Connect to equinox to fetch your decks', {}));
      }

      // RandomDeck
      let canUseRandom = true;
      if (canUseRandom && !$('card-fake-random')) {
        $('overlay-deck-container').insertAdjacentHTML('beforeend', this.tplFakeCard({ id: 'fake-random' }));
        $('card-fake-random').querySelector('.altered-card-wrapper').insertAdjacentHTML(
          'beforeend',
          `<div style='width:100%; height:100%; display:flex; justify-content:center; align-items:center;'>
            <div style='background: #ffffffe8;padding: 15px;border-radius: 15px;font-size: 37px;border: 4px solid black;box-shadow: 1px 1px 4px black;font-weight: bold;'>
              Random deck
            </div>
          </div>`
        );
        this.onClick('card-fake-random', () => this.takeAction('actSelectPrecoDeck', { choice: 'random' }, false));
      }
    },

    onLeavingStateSelectPrecoDeck() {
      this.closeOverlay();
      $('altered-overlay-content').innerHTML = '';
    },

    notif_updateInitialPrecoDeckSelection(n) {
      debug('Notif: update initial preco deck selection', n);
      this.clearPossible();
      this.updatePageTitle();
      this.onEnteringStateSelectPrecoDeck(n.args.args);
    },

    onEnteringStateFetchDecks(args) {
      this.addCancelStateBtn();

      $('altered-overlay-content').innerHTML = '';
      $('altered-overlay-content').insertAdjacentHTML(
        'beforeend',
        `
        <h2>Log in Equinox</h2>
        <div id='apiSetup' style='background: white; padding: 20px; border-radius: 15px; border: 1px solid black;font-size:20px; display:flex; flex-flow:column; justify-content:center;'>
          <div id='apiSubmit' class='action-button bgabutton bgabutton_blue' style="margin-top:20px;">Load decks</div>
        </div>`
      );
      this.openOverlay();

      this.onClick('apiSubmit', () => {
        $('apiSubmit').style.background = '#eab757';
        this.takeAction('actLoadAPIDecks', { lock: false }, false).then((response) => {
          debug(response);
          this.clientState('chooseFetchedDeck', 'Choose one of your deck', { decks: response.data });
        });
      });
    },

    onEnteringStateChooseFetchedDeck(args) {
      this.addCancelStateBtn();

      $('altered-overlay-content').innerHTML = '';
      $('altered-overlay-content').insertAdjacentHTML(
        'beforeend',
        `
        <h2>Choose your deck</h2>
        <div id='apiSetup' style='background: white; padding: 20px; border-radius: 15px; border: 1px solid black;font-size:20px; display:flex; flex-flow:column; justify-content:center;'>
          <ul id='deckList' style='max-height:400px; border:1px solid black; margin-bottom:15px; overflow:auto;'></ul>
        </div>`
      );
      this.addPrimaryActionButton(
        'btnConfirmDeck',
        _('Confirm'),
        () => {
          this.takeAction('actConfirmAPIDeck', {}, false);
        },
        'apiSetup'
      );
      $('btnConfirmDeck').classList.add('disabled');
      this.openOverlay();

      let selected = null;
      args.decks.forEach((deck) => {
        $(`deckList`).insertAdjacentHTML(
          'beforeEnd',
          `<li id='${deck.apiId}' style='border:1px solid black; padding:2px 5px; cursor:pointer;'>${deck.deckName} (${deck.faction})</li>`
        );

        this.onClick(deck.apiId, () => {
          if (selected) {
            $(selected).style.background = '';
          }
          selected = deck.apiId;
          $(selected).style.background = '#eab757';
          $('btnConfirmDeck').classList.add('disabled');

          this.takeAction('actGetDeckInfos', { deckID: JSON.stringify(deck.apiId), lock: false }, false).then((deckContent) => {
            debug(deckContent);
            $(selected).style.background = '#43d743';
            $('btnConfirmDeck').classList.remove('disabled');
          });
        });
      });
    },
    onLeavingStateChooseFetchedDeck() {
      this.closeOverlay();
      $('altered-overlay-content').innerHTML = '';
    },

    // onEnteringStateSelectDeck(args) {
    //   if (!args._private) return;

    //   decks = args._private.decks;
    //   decks.forEach((deck) => {
    //     this.addPrimaryActionButton('btnSelectDeck' + deck.deckNum, 'Deck n°' + deck.deckNum + ' Faction ' + deck.faction, () =>
    //       this.takeAction('actSelectDeck', { choice: deck.deckNum }, false)
    //     );
    //   });

    //   // Open deck container
    //   if (!$('overlay-deck-container')) {
    //     $('altered-overlay-content').innerHTML = '';
    //     $('altered-overlay-content').insertAdjacentHTML(
    //       'beforeend',
    //       `
    //       <h2>${_('Choose your deck')}</h2>
    //       <div id='overlay-deck-container'></div>
    //     `
    //     );

    //     decks.forEach((deck) => {
    //       this.addCard(deck.hero, 'overlay-deck-container');
    //       this.onClick(`card-${deck.hero.id}`, () => this.takeAction('actSelectDeck', { choice: deck.deckNum }, false));
    //     });
    //   }
    //   this.openOverlay();

    //   // Already made a selection => allow to cancel it
    //   let deckNum = args._private.selection;
    //   if (deckNum != null) {
    //     let previousCard = $('overlay-deck-container').querySelector('.altered-card.selected');
    //     if (previousCard) previousCard.classList.remove('selected');
    //     let previousBtn = $('customActions').querySelector('.bgabutton.selected');
    //     if (previousBtn) previousBtn.classList.remove('selected');

    //     $(`btnSelectDeck${deckNum}`).classList.add('selected');
    //     $(`card-${decks[deckNum].hero.id}`).classList.add('selected');
    //   }
    // },

    // onLeavingStateSelectDeck() {
    //   this.closeOverlay();
    //   $('altered-overlay-content').innerHTML = '';
    // },

    // notif_updateInitialDeckSelection(n) {
    //   this.clearPossible();
    //   this.updatePageTitle();
    //   this.onEnteringStateSelectDeck(n.args.args);
    // },

    notif_vsScreen(n) {
      debug('Notif: VS screen', n);
      // $('altered-overlay-content').innerHTML = '';
      // $('altered-overlay-content').insertAdjacentHTML(
      //   'beforeend',
      //   `<div id='vs-left'>
      //       MUNA
      //   </div>
      //   <div id='vs-container'></div>
      //   <div id='vs-right'>
      //     LYRA
      //   </div>`
      // );
    },

    //////////////////////////////////////////////////////
    //  _   _                 ____
    // | \ | | _____      __ |  _ \  __ _ _   _
    // |  \| |/ _ \ \ /\ / / | | | |/ _` | | | |
    // | |\  |  __/\ V  V /  | |_| | (_| | |_| |
    // |_| \_|\___| \_/\_/   |____/ \__,_|\__, |
    //                                    |___/
    //////////////////////////////////////////////////////

    onEnteringStateNewDayManaSelection(args) {
      if (!args._private) return;

      // first day, handle differently since it's multiactive
      if (!args.canPass) {
        this.onEnteringStateFirstDayManaSelection(args);
        return;
      }

      console.error('SHOULD NOT HAPPEN !!');
    },

    onEnteringStateFirstDayManaSelection(args) {
      debug('onEnteringStateFirstDayManaSelection');
      this.openHand();
      let n = args._private.n;

      let cardIds = null;
      if (!$('overlay-hand-container')) {
        $('altered-overlay-content').innerHTML = '';
        $('altered-overlay-content').insertAdjacentHTML(
          'beforeend',
          `
          <h2>${_('Choose your starting mana cards')}</h2>
          <p>${_('Selected cards will join your mana pool')}</p>
          <div id='overlay-hand-container'></div>
          <div id='overlay-new-day-counter-wrapper' class='invalid'>
            <span id='overlay-new-day-counter'>0</span>
            /
            ${n}
          </div>
        `
        );

        $('overlay-hand-container').insertAdjacentElement('beforeend', $(`hand-${this.player_id}`));
        this.clearHandTransform($(`hand-${this.player_id}`));
        this.openOverlay();
      }
      this.addToggleOverlayButton();

      // Already made a selection => allow to cancel it
      if (args._private.selection != null) {
        args._private.selection.forEach((cardId) => {
          $(`card-${cardId}`).classList.add('selectedToMana');
        });
        $('overlay-new-day-counter').innerHTML = 3;
        $('overlay-new-day-counter-wrapper').classList.remove('invalid');

        // Remove confirm button
        if ($('btnConfirmManaSelection')) $('btnConfirmManaSelection').remove();

        // Cancel buttons
        this.addSecondaryActionButton('actCancelFirstDayManaSelection', _('Cancel'), () =>
          this.takeAction('actCancelFirstDayManaSelection', {}, false)
        );
        $('altered-overlay-content').insertAdjacentHTML(
          'beforeend',
          `<a href="#" class="action-button bgabutton bgabutton_gray" id="btnCancelManaSelection">${_('Cancel')}</a>`
        );
        this.onClick('btnCancelManaSelection', () => {
          this.takeAction('actCancelFirstDayManaSelection', {}, false);
        });
      }
      // No selection yet => let the user click on it
      else {
        // Remove confirm button
        if ($('btnCancelManaSelection')) $('btnCancelManaSelection').remove();

        // Confirm button
        if (!$('btnConfirmManaSelection')) {
          $('altered-overlay-content').insertAdjacentHTML(
            'beforeend',
            `<a href="#" class="action-button bgabutton bgabutton_blue disabled" id="btnConfirmManaSelection">${_('Confirm')}</a>`
          );
          this.onClick('btnConfirmManaSelection', () => {
            this.takeAction('actFirstDayManaSelection', { cardIds: JSON.stringify(cardIds) });
          });
        }

        this.onSelectNCards(args._private.cards, {
          n,
          class: 'selectedToMana',
          confirmText: _('Confirm Mana'),
          updateCallback: (selectedElements) => {
            cardIds = selectedElements;
            $('overlay-new-day-counter').innerHTML = selectedElements.length;
            $('btnConfirmManaSelection').classList.toggle('disabled', selectedElements.length != n);
            $('overlay-new-day-counter-wrapper').classList.toggle('invalid', selectedElements.length != n);
          },
          callback: (selectedElements, ignoredElements) =>
            this.takeAction('actFirstDayManaSelection', { cardIds: JSON.stringify(selectedElements) }),
        });
      }
    },

    onLeavingStateFirstDayManaSelection() {
      this.closeOverlayIfOpened();
    },

    notif_updateFirstDayManaSelection(n) {
      this.clearPossible();
      this.updatePageTitle();
      this.onEnteringStateFirstDayManaSelection(n.args.args);
    },

    ////////////////////////////////////////
    //  _____             _
    // | ____|_ __   __ _(_)_ __   ___
    // |  _| | '_ \ / _` | | '_ \ / _ \
    // | |___| | | | (_| | | | | |  __/
    // |_____|_| |_|\__, |_|_| |_|\___|
    //              |___/
    ////////////////////////////////////////

    addActionChoiceBtn(choice, disabled = false) {
      if ($('btnChoice' + choice.id)) return;

      let desc = this.translate(choice.description);
      desc = this.formatString(desc);

      // Add source if any
      let source = _(choice.source ? choice.source : '');
      if (choice.sourceId) {
        // TODO?
        // let card = this.getCardInfos(choice.sourceId);
        // source = this.fsr('${card_name}', { i18n: ['card_name'], card_name: _(card.name), card_id: card.id });
      }

      if (source != '') {
        desc += ` (${source})`;
      }

      this.addSecondaryActionButton(
        'btnChoice' + choice.id,
        desc,
        disabled
          ? () => {}
          : () => {
              this.askConfirmation(choice.irreversibleAction, () => this.takeAction('actChooseAction', { id: choice.id }));
            }
      );
      if (disabled) {
        $(`btnChoice${choice.id}`).classList.add('disabled');
      }
      if (choice.description.args && choice.description.args.bonus_pentagon) {
        $(`btnChoice${choice.id}`).classList.add('withbonus');
      }
    },

    onEnteringStateResolveChoice(args) {
      Object.values(args.choices).forEach((choice) => this.addActionChoiceBtn(choice, false));
      Object.values(args.allChoices).forEach((choice) => this.addActionChoiceBtn(choice, true));
    },

    onEnteringStateImpossibleAction(args) {
      this.addActionChoiceBtn(
        {
          choiceId: 0,
          description: args.desc,
        },
        true
      );
    },

    addConfirmTurn(args, action) {
      this.addPrimaryActionButton('btnConfirmTurn', _('Confirm'), () => {
        this.stopActionTimer();
        this.takeAction(action);
      });

      const OPTION_CONFIRM = 103;
      let n = args.previousEngineChoices;
      let timer = Math.min(10 + 2 * n, 20);
      this.startActionTimer('btnConfirmTurn', timer, this.prefs[OPTION_CONFIRM].value);
    },

    onEnteringStateConfirmTurn(args) {
      this.addConfirmTurn(args, 'actConfirmTurn');
    },

    onEnteringStateConfirmPartialTurn(args) {
      this.addConfirmTurn(args, 'actConfirmPartialTurn');
    },

    askConfirmation(warning, callback) {
      if (warning === false || this.prefs[104].value == 0) {
        callback();
      } else {
        //        let msg = warning === true ? _('drawing card(s) from the deck or the discard') : warning;
        let msg =
          warning === true
            ? _(
                "If you take this action, you won't be able to undo past this step because you will either roll a dice, draw card(s) from the deck or the discard, or someone else is going to make a decision"
              )
            : warning;
        this.confirmationDialog(
          msg,
          // this.fsr(
          //   _("If you take this action, you won't be able to undo past this step because of the following reason: ${msg}"),
          //   { msg }
          // ),
          () => {
            callback();
          }
        );
      }
    },

    // Generic call for Atomic Action that encode args as a JSON to be decoded by backend
    takeAtomicAction(action, args, warning = false) {
      if (!this.checkAction(action)) return false;

      this.askConfirmation(warning, () =>
        this.takeAction('actTakeAtomicAction', { actionName: action, actionArgs: JSON.stringify(args) }, false)
      );
    },

    ///////////////////////////////////////
    //     _        _   _
    //    / \   ___| |_(_) ___  _ __  ___
    //   / _ \ / __| __| |/ _ \| '_ \/ __|
    //  / ___ \ (__| |_| | (_) | | | \__ \
    // /_/   \_\___|\__|_|\___/|_| |_|___/
    ///////////////////////////////////////
    unselectIfNeeded() {
      let oCard = $(`hand-${this.player_id}`).querySelector('.selected');
      if (!oCard) {
        oCard = $(`board-reserve-${this.player_id}`).querySelector('.selected');
      }
      if (!oCard) {
        oCard = $(`board-limbo-${this.player_id}`).querySelector('.selected');
      }
      if (!oCard) return;

      oCard.style.transform = oCard.backup.transform;
      oCard.style.left = oCard.backup.left;
      oCard.style.top = oCard.backup.top;
      //        this.wait(400).then(() => oCard.classList.remove('selected'));
    },

    onEnteringStateChooseAssignment(args) {
      let t = args._private;

      if (t.play) {
        Object.keys(t.play).forEach((cardId) => {
          // ALREADY SELECTED CARD
          if (cardId == args.cardId) {
            console.log('test1');
            this.wait(250).then(() => {
              this.onClick('altered-board-me', () => {
                this.unselectIfNeeded();
                this.clearClientState();
              });

              this.onClick(`card-${cardId}`, () => {
                console.log('test');
                this.unselectIfNeeded();
                this.clearClientState();
              });
            });
          }
          // OTHER CARD
          else {
            this.onClick(`card-${cardId}`, () => {
              this.unselectIfNeeded();
              let supportPossible = t.hasOwnProperty('support') ? t.support.includes(parseInt(cardId)) : false;
              this.clientState(
                'chooseAssignmentLocation',
                supportPossible ? _('What do you want to do with that card?') : _('Where do you want to play that card?'),
                {
                  play: t.play,
                  support: t.support,
                  tap: t.tap,
                  cardId,
                  supportPossible,
                }
              );
            });
          }
        });
      }

      if (t.support) {
        t.support.forEach((cardId) => {
          if (t.hasOwnProperty('play') && Object.keys(t.play).includes(`${cardId}`)) return;
          if ($(`card-${cardId}`).classList.contains('selected')) return;
          console.log('test2');

          this.onClick(`card-${cardId}`, () => {
            this.unselectIfNeeded();

            this.clientState('chooseAssignmentLocation', _('Where do you want to play that card?'), {
              play: t.play,
              support: t.support,
              tap: t.tap,
              cardId,
              supportPossible: t.hasOwnProperty('support') ? t.support.includes(parseInt(cardId)) : false,
            });
          });
        });
      }

      if (t.tap) {
        t.tap.forEach((cardId) => {
          this.unselectIfNeeded();
          this.onClick(`card-${cardId}`, () => this.takeAtomicAction('actTap', [cardId]));
        });
      }

      this.addDangerActionButton(
        'btnPass',
        _('Pass'),
        () => {
          this.unselectIfNeeded();
          this.takeAtomicAction('actPass', []);
        },
        'restartAction'
      );
    },

    onEnteringStateChooseAssignmentLocation(args) {
      this.addSecondaryActionButton(
        'btnCancel',
        _('Cancel'),
        () => {
          this.unselectIfNeeded();
          this.clearClientState();
        },
        'restartAction'
      );

      this.addCancelStateBtn();
      if (!args.hasOwnProperty('clientState') || args.clientState == true) {
        // this.addCancelStateBtn();
        this.onEnteringStateChooseAssignment({
          cardId: args.cardId,
          _private: { play: args.play, support: args.support, tap: args.tap },
        });
      }

      // Mark card as selected
      let cardId = args.cardId;
      oCard = $(`card-${cardId}`);
      oCard.classList.add('selected');
      if (args.supportPossible) {
        this.onClick(oCard.querySelector('.card-support-icon'), () => {
          this.takeAtomicAction('actSupport', [cardId]);
        });
      }
      // Backup previous pos and transform
      oCard.backup = {
        transform: oCard.style.transform,
        left: oCard.style.left || '0px',
        top: oCard.style.top || '0px',
      };

      // Slide it using css transition, unless parent is reserve
      let limbo = $(`board-limbo-${this.player_id}`);
      oCard.style.transform = 'scale(1.2) rotate(0rad) translateY(0px)';
      if (oCard.parentNode.classList.contains('player-board-reserve')) {
        this.slide(oCard, limbo, { duration: 100, changeParent: false, attach: false, phantom: false, clearPos: false });
      } else {
        oCard.style.left = limbo.offsetLeft + 'px';
        oCard.style.top = limbo.offsetTop + 'px';
      }

      let onChooseLocation = (location) => {
        return () => this.takeAtomicAction('actPlay', [cardId, location]);
      };

      const names = {
        stormLeft: _('Hero side'),
        stormRight: _('Companion side'),
        landmark: _('Landmark'),
        reserve: _('Reserve'),
        limbo: _('Spell'),
      };

      if (args.play[cardId] != undefined) {
        args.play[cardId].forEach((location, i) => {
          this.addPrimaryActionButton('btnLocation' + i, names[location], onChooseLocation(location));
          this.onClick(`board-${location}-${this.player_id}`, onChooseLocation(location));

          if (location == 'limbo') {
            this.wait(200).then(() => {
              if ($(`card-${cardId}`).classList.contains('selected')) {
                this.addPrimaryActionButton(
                  'btnLaunchSpell',
                  this.formatSvgIcon('spell'),
                  onChooseLocation(location),
                  `board-limbo-${this.player_id}`
                );

                if ($(`card-${cardId}`).classList.contains('mini-card')) {
                  $('btnLaunchSpell').classList.add('on-mini-card');
                }
              }
            });
          }
        });
      }

      if (args.supportPossible == true) {
        this.addPrimaryActionButton(
          'btnSupportAbility',
          _('Support ability') + oCard.querySelector('.card-support-icon').innerHTML,
          () => this.takeAtomicAction('actSupport', [cardId])
        );
      }
    },

    onEnteringStateTarget(args) {
      let location = 'hand';

      if (args.manaOrbs == true) {
        this.addPrimaryActionButton('btnShowMana', _('Show mana cards'), () => this._manaModal.show());
        this._manaModal.show();

        if (!$('popin_manaDisplay_subtitle')) {
          $('popin_manaDisplay_title').insertAdjacentHTML('afterend', '<h3 id="popin_manaDisplay_subtitle"></h3>');
        }
        $('popin_manaDisplay_subtitle').innerHTML = $('pagemaintitletext').innerHTML;

        location = 'mana';
      }

      this.onSelectNCards(
        args.cardIds,
        {
          n: args.n,
          class: 'selectable',
          confirmText: _('Confirm target'),
          upTo: args.upTo,
          callback: (selectedElements, ignoredElements) => this.takeAtomicAction('actTarget', [selectedElements]),
          passCallback: () => this.takeAction('actPassOptionalAction'),
        },
        location
      );

      Object.keys(args.targetCosts).forEach((cardId) => {
        $(`card-${cardId}`).insertAdjacentHTML('beforeend', `<div class='tough-marker'>${args.targetCosts[cardId]}</div>`);
      });
    },

    onEnteringStateDiscardDraw(args) {
      this.onEnteringStateTarget(args);
    },

    onLeavingStateTarget() {
      document.querySelectorAll('.tough-marker').forEach((o) => o.remove());
    },

    onEnteringStatePlayCard(args) {
      let cardId = args.cardId;
      $(`card-${cardId}`).classList.add('selected');

      let onChooseLocation = (location) => {
        return () => this.takeAtomicAction('actPlayCard', [cardId, location]);
      };

      const names = {
        stormLeft: _('Hero side'),
        stormRight: _('Companion side'),
        landmark: _('Landmark'),
        reserve: _('Reserve'),
        limbo: _('Spell'),
      };

      if (args._private.play[cardId] != undefined) {
        args._private.play[cardId].forEach((location, i) => {
          this.addPrimaryActionButton('btnLocation' + i, names[location], onChooseLocation(location));
          this.onClick(`board-${location}-${this.player_id}`, onChooseLocation(location));
        });
      }
      // this.clientState('chooseAssignmentLocation', _('Where do you want to play that card?'), {
      //   play: args._private.play,
      //   support: [],
      //   tap: [],
      //   cardId: args.cardId,
      //   supportPossible: false,
      //   clientState: false,
      // });
    },

    onEnteringStateInvokeToken(args) {
      const names = {
        stormLeft: _('Hero side'),
        stormRight: _('Companion side'),
        source: _('source'),
        oppositeSource: _('opposite of played card'),
      };

      let onChooseLocation = (location) => {
        return () => this.takeAtomicAction('actInvokeToken', [location]);
      };

      args.locations.forEach((location, i) => {
        debug(location);
        this.addPrimaryActionButton('btnLocation' + i, names[location], onChooseLocation(location));
        if (location == 'stormLeft' || location == 'stormRight') {
          this.onClick(`board-${location}-${this.player_id}`, onChooseLocation(location));
        }
      });
    },

    onEnteringStateBlockExpedition(args) {
      const names = {
        stormLeft: _('Hero side'),
        stormRight: _('Companion side'),
        source: _('source'),
        oppositeSource: _('opposite of played card'),
      };

      let onChooseLocation = (location) => {
        return () => this.takeAtomicAction('actBlockExpedition', [location]);
      };

      this.forEachPlayer((player) => {
        ['stormLeft', 'stormRight'].forEach((location) => {
          this.onClick(`board-${location}-${player.id}`, onChooseLocation(`board-${location}-${player.id}`));
        });
      });
    },

    onEnteringStateTargetExpedition(args) {
      const names = {
        stormLeft: _('Hero side'),
        stormRight: _('Companion side'),
        source: _('source'),
        oppositeSource: _('opposite of played card'),
      };

      let onChooseLocation = (location) => {
        return () => this.takeAtomicAction('actTargetExpedition', [location]);
      };

      this.forEachPlayer((player) => {
        ['stormLeft', 'stormRight'].forEach((location) => {
          this.onClick(`board-${location}-${player.id}`, onChooseLocation(`board-${location}-${player.id}`));
        });
      });
    },

    onEnteringStateTargetPlayer(args) {
      let targetPlayer = (player) => {
        return () => this.takeAtomicAction('actTargetPlayer', [player]);
      };

      this.forEachPlayer((player) => {
        this.addPrimaryActionButton('btnTargetr' + player.id, player.name, targetPlayer(player.id));
      });
    },

    onEnteringStateRollDie(args) {
      let chooseRollDie = (roll) => {
        return () => this.takeAtomicAction('actRollDie', [roll]);
      };

      args.rolls.forEach((roll, i) => {
        this.addPrimaryActionButton('btnRoll' + i, roll, chooseRollDie(roll));
      });

      // management of All In rare
      if (args.canDiscard == true) {
        this.onSelectNCards(args.cardIds, {
          n: 1,
          class: 'selectable',
          confirmText: _('Confirm discard to increase die by 2'),
          callback: (selectedElements, ignoredElements) => this.takeAtomicAction('actDiscardAdd', [selectedElements]),
        });
      }
    },

    onEnteringStateMoveExpedition(args) {
      let onChooseLocation = (expe) => {
        return () => this.takeAtomicAction('actMoveExpedition', [expe]);
      };

      args.expeditions.forEach((expe, i) => {
        let pId = expe[0],
          location = expe[1];

        this.onClick(`board-${location}-${pId}`, onChooseLocation(expe));
        if (pId == this.player_id) {
          desc = location == 'stormLeft' ? _('My Hero expedition') : _('My Companion expedition');
        } else {
          desc = location == 'stormLeft' ? _('Opponent Hero expedition') : _('Opponent Companion expedition');
        }
        this.addPrimaryActionButton('btnLocation' + i, desc, onChooseLocation(expe));
      });
    },

    ////////////////////////////////////////////////////////////
    // _____                          _   _   _
    // |  ___|__  _ __ _ __ ___   __ _| |_| |_(_)_ __   __ _
    // | |_ / _ \| '__| '_ ` _ \ / _` | __| __| | '_ \ / _` |
    // |  _| (_) | |  | | | | | | (_| | |_| |_| | | | | (_| |
    // |_|  \___/|_|  |_| |_| |_|\__,_|\__|\__|_|_| |_|\__, |
    //                                                 |___/
    ////////////////////////////////////////////////////////////

    /**
     * Replace some expressions by corresponding html formating
     */
    formatIcon(name, n = null, lowerCase = true) {
      let type = lowerCase ? name.toLowerCase() : name;
      const NO_TEXT_ICONS = [];
      let noText = NO_TEXT_ICONS.includes(name);
      let text = n == null ? '' : `<span>${n}</span>`;
      return `${noText ? text : ''}<div class="icon-container icon-container-${type}">
            <div class="altered-icon icon-${type}">${noText ? '' : text}</div>
          </div>`;
    },

    // SVG ICONS AVAILABLE :
    formatSvgIcon(name) {
      let glyphs = {
        anchored: 1,
        artist: 5,
        btg: 1,
        card: 1,
        charge: 1,
        discard: 2,
        fleeting: 1,
        forest: 1,
        hand: 1,
        infinity: 2,
        'mana-0': 2,
        'mana-1': 2,
        'mana-2': 2,
        'mana-3': 2,
        'mana-4': 2,
        'mana-5': 2,
        'mana-6': 2,
        'mana-7': 2,
        'mana-8': 2,
        'mana-9': 2,
        'mana-X': 2,
        'mana-$1': 2, // Useful only for substitution into regex
        mountain: 1,
        ocean: 1,
        permanent: 1,
        played: 1,
        reserve: 8,
        spell: 1,
        sleep: 1,
        tap: 1,
      };

      let icon = `<i class='svgicon-${name}'>`;
      let nGlyphs = glyphs[name];
      if (nGlyphs > 1) {
        for (let i = 1; i <= nGlyphs; i++) {
          icon += `<span class="path${i}"></span>`;
        }
      }
      icon += '</i>';
      return icon;
      // let svgId = name + '-svg';
      // let viewBox = $(svgId).getAttribute('viewBox');
      // return `<div class='inline-icon'><svg viewBox="${viewBox}"><use href="#${svgId}" /></svg></div>`;
    },

    formatString(str, italicParenthesis = false) {
      const ICONS = ['BOOST', 'ANCHORED', 'FLEETING', 'ASLEEP'];
      ICONS.forEach((name) => {
        const regex = new RegExp('<' + name + ':([^>]+)>', 'g');
        str = str.replaceAll(regex, this.formatIcon(name, '<span>$1</span>'));
        str = str.replaceAll(new RegExp('<' + name + '>', 'g'), this.formatIcon(name));
      });

      const MARKERS_MAP = {
        J: 'played',
        j: 'played',
        H: 'hand',
        h: 'hand',
        R: 'reserve',
        r: 'reserve',
        D: 'discard',
        T: 'tap',
        V: 'forest',
        E: 'ocean',
        COUNTER: 'charge',
      };
      Object.keys(MARKERS_MAP).forEach((marker) => {
        const regex = new RegExp('{' + marker + '}', 'g');

        let svgs = MARKERS_MAP[marker];
        if (!Array.isArray(svgs)) svgs = [svgs];
        let svgStr = '';
        svgs.forEach((svg) => (svgStr += this.formatSvgIcon(svg)));

        str = str.replace(regex, svgStr);
      });
      // str = str.replace(/__([^_]+)__/g, '<span class="action-card-name-reference">$1</span>');
      str = str.replace(/\#(.+?)\#/g, '<span class="rare-marker">$1</span>');
      str = str.replace(/\[\[([^\]]+)\]\]/g, '<span class="effect-reference-emphasis">$1</span>');
      str = str.replace(/\[([^\]]+)\]/g, '<span class="effect-reference">$1</span>');
      str = str.replace(/\{([0-9X]+)\}/g, this.formatSvgIcon('mana-$1'));
      if (italicParenthesis) str = str.replace(/(\([^\)]+\))/g, '<span class="parenthesis">$1</span>');

      return str;
    },

    /**
     * Format log strings
     *  @Override
     */
    format_string_recursive(log, args) {
      try {
        if (log && args && !args.processed) {
          args.processed = true;

          log = this.formatString(_(log));

          if (args.card_name !== undefined && args.card_id !== undefined) {
            // let card = this.getCardInfos(args.card_id);
            // let uid = this.registerCustomTooltip(this.tplCard(card, true));
            // args.card_name = `<span class="ark-log-card-name" id="${uid}">${_(args.card_name)}</span>`;
            args.card_name = `<span class="altered-log-card-name">${_(args.card_name)}</span>`;
          }

          if (args.source !== undefined && args.sourceId !== undefined) {
            // let card = this.getCardInfos(args.card_id);
            // let uid = this.registerCustomTooltip(this.tplCard(card, true));
            // args.source = `<span class="ark-log-card-name" id="${uid}">${_(args.source)}</span>`;
            args.source = `<span class="altered-log-card-name">${_(args.source)}</span>`;
          }

          if (args.effect_desc !== undefined) {
            args.effect_desc = this.formatString(this.translate(args.effect_desc));
          }

          if (args.phase_icon !== undefined) {
            args.phase_icon = this.formatIcon(args.phase);
          }
          if (args.phase_icon2 !== undefined) {
            args.phase_icon2 = this.formatIcon(args.phase);
          }

          if (args.biome_icon !== undefined) {
            let icon = args.biome_name;
            if (icon == 'water') icon = 'ocean';
            args.biome_icon = this.formatSvgIcon(icon);
            args.biome_name = '';
          }

          if (args.mana_cost !== undefined) {
            args.mana_cost = this.formatSvgIcon('mana-' + args.mana_cost);
          }
        }
      } catch (e) {
        console.error(log, args, 'Exception thrown', e.stack);
      }

      return this.inherited(arguments);
    },

    //////////////////////////////////////////////////////
    //  ___        __         ____                  _
    // |_ _|_ __  / _| ___   |  _ \ __ _ _ __   ___| |
    //  | || '_ \| |_ / _ \  | |_) / _` | '_ \ / _ \ |
    //  | || | | |  _| (_) | |  __/ (_| | | | |  __/ |
    // |___|_| |_|_|  \___/  |_|   \__,_|_| |_|\___|_|
    //////////////////////////////////////////////////////

    setupInfoPanel() {
      dojo.place(this.tplInfoPanel(), 'player_boards', 'first');
      let chk = $('help-mode-chk');
      dojo.connect(chk, 'onchange', () => this.toggleHelpMode(chk.checked));
      this.addTooltip('help-mode-switch', '', _('Toggle help/safe mode.'));

      dojo.connect($('show-settings2'), 'onclick', () => this.toggleSettings());
      this.addTooltip('show-settings2', '', _('Display some settings about the game.'));

      this.setupHelperModal();

      this._settingsModal = new customgame.modal('showSettings', {
        class: 'altered_popin',
        closeIcon: 'fa-times',
        title: _('Settings'),
        closeAction: 'hide',
        scale: 0.9,
        breakpoint: 550,
        verticalAlign: 'flex-start',
        contentsTpl: `<div id='altered-settings'>
             <div id='altered-settings-header'></div>
             <div id="settings-controls-container"></div>
           </div>`,
      });

      // let handWrapper = $('floating-hand-wrapper');
      // $('floating-hand-button').addEventListener('click', () => {
      //   if (handWrapper.dataset.open && handWrapper.dataset.open == 'hand') {
      //     delete handWrapper.dataset.open;
      //   } else {
      //     handWrapper.dataset.open = 'hand';
      //   }
      // });
    },

    tplInfoPanel() {
      return `
   <div class='player-board' id="player_board_config">
     <div id="player_config" class="player_board_content">
       <div class="player_config_row">
         <div id="help-mode-switch">
           <input type="checkbox" class="checkbox" id="help-mode-chk" />
           <label class="label" for="help-mode-chk">
             <div class="ball"></div>
           </label><svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="question-circle" class="svg-inline--fa fa-question-circle fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><g class="fa-group"><path class="fa-secondary" fill="currentColor" d="M256 8C119 8 8 119.08 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 422a46 46 0 1 1 46-46 46.05 46.05 0 0 1-46 46zm40-131.33V300a12 12 0 0 1-12 12h-56a12 12 0 0 1-12-12v-4c0-41.06 31.13-57.47 54.65-70.66 20.17-11.31 32.54-19 32.54-34 0-19.82-25.27-33-45.7-33-27.19 0-39.44 13.14-57.3 35.79a12 12 0 0 1-16.67 2.13L148.82 170a12 12 0 0 1-2.71-16.26C173.4 113 208.16 90 262.66 90c56.34 0 116.53 44 116.53 102 0 77-83.19 78.21-83.19 106.67z" opacity="0.4"></path><path class="fa-primary" fill="currentColor" d="M256 338a46 46 0 1 0 46 46 46 46 0 0 0-46-46zm6.66-248c-54.5 0-89.26 23-116.55 63.76a12 12 0 0 0 2.71 16.24l34.7 26.31a12 12 0 0 0 16.67-2.13c17.86-22.65 30.11-35.79 57.3-35.79 20.43 0 45.7 13.14 45.7 33 0 15-12.37 22.66-32.54 34C247.13 238.53 216 254.94 216 296v4a12 12 0 0 0 12 12h56a12 12 0 0 0 12-12v-1.33c0-28.46 83.19-29.67 83.19-106.67 0-58-60.19-102-116.53-102z"></path></g></svg>
         </div>

         <div id="show-settings">
           <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
             <g>
               <path class="fa-secondary" fill="currentColor" d="M638.41 387a12.34 12.34 0 0 0-12.2-10.3h-16.5a86.33 86.33 0 0 0-15.9-27.4L602 335a12.42 12.42 0 0 0-2.8-15.7 110.5 110.5 0 0 0-32.1-18.6 12.36 12.36 0 0 0-15.1 5.4l-8.2 14.3a88.86 88.86 0 0 0-31.7 0l-8.2-14.3a12.36 12.36 0 0 0-15.1-5.4 111.83 111.83 0 0 0-32.1 18.6 12.3 12.3 0 0 0-2.8 15.7l8.2 14.3a86.33 86.33 0 0 0-15.9 27.4h-16.5a12.43 12.43 0 0 0-12.2 10.4 112.66 112.66 0 0 0 0 37.1 12.34 12.34 0 0 0 12.2 10.3h16.5a86.33 86.33 0 0 0 15.9 27.4l-8.2 14.3a12.42 12.42 0 0 0 2.8 15.7 110.5 110.5 0 0 0 32.1 18.6 12.36 12.36 0 0 0 15.1-5.4l8.2-14.3a88.86 88.86 0 0 0 31.7 0l8.2 14.3a12.36 12.36 0 0 0 15.1 5.4 111.83 111.83 0 0 0 32.1-18.6 12.3 12.3 0 0 0 2.8-15.7l-8.2-14.3a86.33 86.33 0 0 0 15.9-27.4h16.5a12.43 12.43 0 0 0 12.2-10.4 112.66 112.66 0 0 0 .01-37.1zm-136.8 44.9c-29.6-38.5 14.3-82.4 52.8-52.8 29.59 38.49-14.3 82.39-52.8 52.79zm136.8-343.8a12.34 12.34 0 0 0-12.2-10.3h-16.5a86.33 86.33 0 0 0-15.9-27.4l8.2-14.3a12.42 12.42 0 0 0-2.8-15.7 110.5 110.5 0 0 0-32.1-18.6A12.36 12.36 0 0 0 552 7.19l-8.2 14.3a88.86 88.86 0 0 0-31.7 0l-8.2-14.3a12.36 12.36 0 0 0-15.1-5.4 111.83 111.83 0 0 0-32.1 18.6 12.3 12.3 0 0 0-2.8 15.7l8.2 14.3a86.33 86.33 0 0 0-15.9 27.4h-16.5a12.43 12.43 0 0 0-12.2 10.4 112.66 112.66 0 0 0 0 37.1 12.34 12.34 0 0 0 12.2 10.3h16.5a86.33 86.33 0 0 0 15.9 27.4l-8.2 14.3a12.42 12.42 0 0 0 2.8 15.7 110.5 110.5 0 0 0 32.1 18.6 12.36 12.36 0 0 0 15.1-5.4l8.2-14.3a88.86 88.86 0 0 0 31.7 0l8.2 14.3a12.36 12.36 0 0 0 15.1 5.4 111.83 111.83 0 0 0 32.1-18.6 12.3 12.3 0 0 0 2.8-15.7l-8.2-14.3a86.33 86.33 0 0 0 15.9-27.4h16.5a12.43 12.43 0 0 0 12.2-10.4 112.66 112.66 0 0 0 .01-37.1zm-136.8 45c-29.6-38.5 14.3-82.5 52.8-52.8 29.59 38.49-14.3 82.39-52.8 52.79z" opacity="0.4"></path>
               <path class="fa-primary" fill="currentColor" d="M420 303.79L386.31 287a173.78 173.78 0 0 0 0-63.5l33.7-16.8c10.1-5.9 14-18.2 10-29.1-8.9-24.2-25.9-46.4-42.1-65.8a23.93 23.93 0 0 0-30.3-5.3l-29.1 16.8a173.66 173.66 0 0 0-54.9-31.7V58a24 24 0 0 0-20-23.6 228.06 228.06 0 0 0-76 .1A23.82 23.82 0 0 0 158 58v33.7a171.78 171.78 0 0 0-54.9 31.7L74 106.59a23.91 23.91 0 0 0-30.3 5.3c-16.2 19.4-33.3 41.6-42.2 65.8a23.84 23.84 0 0 0 10.5 29l33.3 16.9a173.24 173.24 0 0 0 0 63.4L12 303.79a24.13 24.13 0 0 0-10.5 29.1c8.9 24.1 26 46.3 42.2 65.7a23.93 23.93 0 0 0 30.3 5.3l29.1-16.7a173.66 173.66 0 0 0 54.9 31.7v33.6a24 24 0 0 0 20 23.6 224.88 224.88 0 0 0 75.9 0 23.93 23.93 0 0 0 19.7-23.6v-33.6a171.78 171.78 0 0 0 54.9-31.7l29.1 16.8a23.91 23.91 0 0 0 30.3-5.3c16.2-19.4 33.7-41.6 42.6-65.8a24 24 0 0 0-10.5-29.1zm-151.3 4.3c-77 59.2-164.9-28.7-105.7-105.7 77-59.2 164.91 28.7 105.71 105.7z"></path>
             </g>
           </svg>
         </div>
       </div>
     </div>
   </div>
   `;
    },

    updatePlayerOrdering() {
      this.inherited(arguments);
      dojo.place('player_board_config', 'player_boards', 'first');
    },

    onChangeCardScaleSetting(val) {
      // let scale = val / 100;
      // [...document.querySelectorAll('.player-board-hand')].forEach((elt) => {
      //   elt.style.setProperty('--alteredZooCardScale', scale);
      // });
      // $('floating-hand-wrapper').style.setProperty('--alteredZooCardScale', scale);
    },

    onChangeBoardHeightSetting(val) {
      this.updateLayout();
    },

    onChangeFitToSetting(val) {
      this.updateLayout();
    },

    updateLayout() {
      if (!this.settings) return;
      const ROOT = document.documentElement;

      const IS_FOCUS_MODE = document.body.classList.contains('focus-board');
      const WIDTH = $('altered-main-container').getBoundingClientRect()['width'];
      let HEIGHT =
        (IS_FOCUS_MODE
          ? document.body.clientHeight
          : window.outerHeight || document.documentElement.clientHeight || document.body.clientHeight) - (IS_FOCUS_MODE ? 0 : 62);
      const BOARD_WIDTH = 1401;
      const BOARD_HEIGHT = 1100;

      // TOOLTIP SIZE
      if (HEIGHT < 900) {
        let tooltipScale = HEIGHT / 700;
        ROOT.style.setProperty('--cardScaleTooltip', tooltipScale);
      }

      // if (HEIGHT < WIDTH && WIDTH < BOARD_WIDTH) {
      //   this.biggestHeightLandscape = Math.max(this.biggestHeightLandscape, HEIGHT);
      //   HEIGHT = this.biggestHeightLandscape;
      // }

      let heightS = IS_FOCUS_MODE ? 1 : this.settings.boardHeight / 100;
      if (HEIGHT < WIDTH) {
        heightS = Math.max(0.8, heightS);
      }
      let heightScale = (heightS * HEIGHT) / BOARD_HEIGHT;
      let widthScale = WIDTH / BOARD_WIDTH;
      let scale = Math.min(widthScale, heightScale);

      if (IS_FOCUS_MODE) {
        if (this.settings.fitTo == 1) scale = widthScale;
        else scale = heightScale;
      }
      ROOT.style.setProperty('--boardScale', scale);

      this.centerOverlay();
    },

    /////////////////////////////////////////
    //  _   _      _
    // | | | | ___| |_ __   ___ _ __ ___
    // | |_| |/ _ \ | '_ \ / _ \ '__/ __|
    // |  _  |  __/ | |_) |  __/ |  \__ \
    // |_| |_|\___|_| .__/ \___|_|  |___/
    //              |_|
    /////////////////////////////////////////

    openHelperModal() {
      this._helperModal.show();
    },

    setupHelperModal() {
      this._helperModal = new customgame.modal('helperModal', {
        class: 'altered_popin',
        closeIcon: 'fa-times',
        closeAction: 'hide',
        verticalAlign: 'flex-start',
        contentsTpl: `<div id='altered-helpers'>
          <div id='helper-phases'>
            <h2>${_('Phases of the day')}</h2>

            <h3>${this.formatIcon('morning')} ${_('Phase 1: Morning')}</h3>
            <ul>
              <li>${_('Change first player')}</li>
              <li>${_('Ready your cards')}</li>
              <li>${_('Draw two cards')}</li>
              <li>${_('Put a card in Mana')}</li>
            </ul>

            <h3>${this.formatIcon('noon')} ${_('Phase 2: Noon')}</h3>
            <ul>
              <li>${_('Apply "At Noon" effects')}</li>
            </ul>

            <h3>${this.formatIcon('afternoon')} ${_('Phase 3: Afternoon')}</h3>
            <h4>${_('Go back and forth taking turns')}</h4>
            <ul>
              <li>${_('You can activate Quick actions')} (${this.formatSvgIcon('discard')} & ${this.formatSvgIcon('tap')})</li>
            </ul>

            <h4>${_('Then either:')}</h4>
            <ul>
              <li>${_('Play a card from your hand or Reserve')}</li>
              <li>${_('Pass the turn and end your Afternoon')}</li>
            </ul>

            <h3>${this.formatIcon('dusk')} ${_('Phase 4: Dusk')}</h3>
            <ul>
              <li>${_('Compare statistics and check which expeditions move forward')}</li>
            </ul>

            <h3>${this.formatIcon('night')} ${_('Phase 5: Night')}</h3>
            <ul>
              <li>${_('Apply "At Night" effects')}</li>
              <li>${_('Rest: Characters go to Reserve')}</li>
              <li>${_('Keep up to 2 cards in Reserve and 2 in Landmarks, discard the rest')}</li>
            </ul>
          </div>
          <div id='helper-icons'>
            <h2>${_('Icons')}</h2>

            <div class='icon-item'>${_("When I'm played from anywhere...")}</div>
            <div class='icon-item'>${_("When I'm played from hand...")}</div>
            <div class='icon-item'>${_("When I'm played from your Reserve")}</div>


            <div class='icon-item'>${_('Exhaust')}</div>
            <div class='icon-item'>${_('Fleeting')}</div>
            <div class='icon-item'>${_('Anchored')}</div>
            <div class='icon-item'>${_('Asleep')}</div>
          </div>
        </div>`,
      });
    },
  });
});
