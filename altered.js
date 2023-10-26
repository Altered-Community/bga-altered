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
  return declare('bgagame.altered', [customgame.game, altered.players, altered.cards, altered.meeples], {
    constructor: function () {
      this._inactiveStates = [];
      this._notifications = [
        ['midMessage', 1200],
        ['clearTurn', 200],
        ['refreshUI', 200],
        ['refreshHand', 200],
        ['updateNewDayManaSelection', 200],
        ['nightCleanup', null],
        ['cleanupCards', null],
        ['newFirstPlayer', null],

        ['addMeeples', null],

        ['pDrawCards', null],
        ['drawCards', null, (notif) => notif.args.player_id == this.player_id],
        ['pDiscardCards', null],
        ['publicDiscard', 200],
        ['discardCards', null, (notif) => notif.args.player_id == this.player_id],
        // ['discardCardsOnDisplay', null],
        ['playCard', null],
        ['moveStormToken', null],
        ['silentKill', 200],
        ['looseToken', 200],
        ['updateBiomes', 100],
        ['spellCleanup', 100],
        ['invokeToken', 100],

        ['setupPlayer', null],
        ['payMana', 500],
        ['discard', 500],
        ['tap', 500],
        ['boost', 500],
        ['untap', 500],
      ];

      // Fix mobile viewport (remove CSS zoom)
      this.default_viewport = 'width=740';
      this.cardStatuses = {};
    },
    notif_midMessage(n) {},

    getSettingsSections() {
      return {
        layout: _('Layout'),
        playerBoard: _('Player Board/Panel'),
        gameFlow: _('Game Flow'),
        other: _('Other'),
      };
    },

    getSettingsConfig() {
      return {
        ////////////////////
        ///    LAYOUT    ///
        handLocation: {
          default: (isMobile, isTouchDevice) => (isTouchDevice ? 1 : 3),
          name: _('Hand of cards'),
          type: 'select',
          values: {
            0: _('In a floating collapsible container'),
            3: _('In a floating collapsible container, opened when entering the table'),
            1: _('Above played cards'),
            2: _('Below played cards'),
          },
          section: 'layout',
        },
        cardScale: {
          default: 40,
          name: _('Card size in hand'),
          type: 'slider',
          sliderConfig: {
            step: 3,
            padding: 0,
            range: {
              min: [30],
              max: [80],
            },
          },
          section: 'layout',
        },

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

        //////////////////////
        /////// OTHER ////////
        sortableHand: {
          default: (isMobile, isTouchDevice) => (isTouchDevice ? 1 : 0),
          name: _('Sortable hand using dragndrop'),
          type: 'select',
          values: {
            0: _('Enabled'),
            1: _('Disabled'),
          },
          section: 'other',
        },
      };
    },

    isFloatingHand() {
      return [0, 3].includes(parseInt(this.settings.handLocation));
    },

    openHand() {
      if (this.isFloatingHand()) {
        $('floating-hand-wrapper').dataset.open = 'hand';
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

      this.setupInfoPanel();
      this.setupBoard();
      this.setupPlayers();
      this.setupCards();
      this.updateHandCards();
      this.setupMeeples();
      // this.setupSortableHand();
      this.inherited(arguments);
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

    setupBoard() {
      let storm = this.gamedatas.storm;
      storm.forEach((stormCard, i) => {
        $('storm-container').insertAdjacentHTML(
          'beforeend',
          `<div class='storm-card-container' id='storm-card-container-${i}'>
            <div class='storm-card' data-id='${stormCard.cardId % 10}' data-flipped='${stormCard.rotated ? 1 : 0}'></div>
          </div>`
        );
      });

      for (let i = 0; i < 8; i++) {
        $('storm-container').insertAdjacentHTML(
          'beforeend',
          `<div class='storm-space' id='storm-${i}'>
            <div class='storm-slot' id='storm-${i}-opponent'></div>
            <div class='storm-slot' id='storm-${i}-player'></div>
          </div>`
        );
      }
    },

    onChangeSortableHandSetting(v) {
      if (this._sortableHand) this._sortableHand.option('disabled', v == 1);

      this.ensureNoSortableHandOnTouchDevice();
    },

    ensureNoSortableHandOnTouchDevice() {
      if (this.isTouchDevice && this.settings && this.settings.sortableHand == 0 && this.isFloatingHand() && this._sortableHand) {
        this._sortableHand.option('disabled', true);

        this.showMessage(
          _(
            "Sortable hand with floating hand on touchscreen is disabled because it's buggy on many devices (can't click on card to select them). Sorry for the inconvenience."
          ),
          'info'
        );
      }
    },

    onLoadingComplete() {
      this.updateLayout();
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

      ['meeples', 'players', 'cards'].forEach((value) => {
        this.gamedatas[value] = n.args.datas[value];
      });
      this.setupCards();
      this.setupMeeples();
      this.updatePlayersCounters();
    },

    notif_refreshHand(n) {
      debug('Notif: refreshing UI', n);
      this.gamedatas.players[n.args.player_id].hand = n.args.hand;
      this.updateHandCards();
    },

    onUpdateActionButtons(stateName, args) {
      //        this.addPrimaryActionButton('test', 'test', () => this.testNotif());
      this.inherited(arguments);
    },

    testNotif() {},

    clearPossible() {
      dojo.empty('pagesubtitle');

      dojo.query('.selectedToDiscard').removeClass('selectedToDiscard');
      dojo.query('.selectedToKeep').removeClass('selectedToKeep');

      let toRemove = [];
      toRemove.forEach((eltId) => {
        if ($(eltId)) $(eltId).remove();
      });

      this.inherited(arguments);
    },

    onEnteringState(stateName, args) {
      debug('Entering state: ' + stateName, args);
      if (this.isFastMode() && ![].includes(stateName)) return;

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
      if (args.args && args.args.previousEngineChoices && args.args.previousEngineChoices >= 1 && !args.args.automaticAction) {
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
      this.openHand();

      // Already made a selection => allow to cancel it
      if (args._private.selection != null) {
        this.addSecondaryActionButton('actCancelNewDayManaSelection', _('Cancel'), () =>
          this.takeAction('actCancelNewDayManaSelection', {}, false)
        );
        args._private.selection.forEach((cardId) => {
          $(`card-${cardId}`).classList.add('selectedToMana');
        });
      }
      // No selection yet => let the user click on it
      else {
        this.onSelectNCards(args._private.cards, {
          n: args._private.n,
          class: 'selectedToMana',
          confirmText: _('Confirm Mana'),
          callback: (selectedElements, ignoredElements) =>
            this.takeAction('actNewDayManaSelection', { cardIds: JSON.stringify(selectedElements) }),
        });
      }

      // if not first day, player can pass
      if (args.canPass) {
        this.addSecondaryActionButton('btnPass', _('Pass'), () => this.takeAction('actPassNewDayManaSelection', {}));
      }
    },

    notif_updateNewDayManaSelection(n) {
      this.clearPossible();
      this.updatePageTitle();
      this.onEnteringStateNewDayManaSelection(n.args.args);
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
        let card = this.getCardInfos(choice.sourceId);
        source = this.fsr('${card_name}', { i18n: ['card_name'], card_name: _(card.name), card_id: card.id });
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
                "If you take this action, you won't be able to undo past this step because you will either draw card(s) from the deck or the discard, or someone else is going to make a choice"
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
    onEnteringStateChooseAssignment(args) {
      let t = args._private;
      if (t.play) {
        Object.keys(t.play).forEach((cardId) => {
          this.onClick(`card-${cardId}`, () =>
            this.clientState('chooseAssignmentLocation', _('Where do you want to play that card?'), {
              play: t.play,
              cardId,
            })
          );
        });
      }

      this.addDangerActionButton('btnPass', _('Pass'), () => {
        this.takeAtomicAction('actPass', []);
      });
    },

    onEnteringStateChooseAssignmentLocation(args) {
      this.addCancelStateBtn();
      this.onEnteringStateChooseAssignment({ _private: { play: args.play } });
      let cardId = args.cardId;
      $(`card-${cardId}`).classList.add('selected');

      let onChooseLocation = (location) => {
        return () => this.takeAtomicAction('actPlay', [cardId, location]);
      };

      const names = {
        stormLeft: _('Hero side'),
        stormRight: _('Companion side'),
        permanent: _('Permanent'),
        memory: _('Memory'),
        limbo: _('Spell'),
      };
      args.play[cardId].forEach((location, i) => {
        this.addPrimaryActionButton('btnLocation' + i, names[location], onChooseLocation(location));
        this.onClick(`board-${location}-${this.player_id}`, onChooseLocation(location));
      });
    },

    onEnteringStateTarget(args) {
      this.onSelectNCards(args.cardIds, {
        n: args.n,
        class: 'selectable',
        confirmText: _('Confirm target'),
        upTo: args.upTo,
        callback: (selectedElements, ignoredElements) => this.takeAtomicAction('actTarget', [selectedElements]),
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

    formatSvgIcon(name) {
      let svgId = name + '-svg';
      let viewBox = $(svgId).getAttribute('viewBox');
      return `<div class='inline-icon'><svg viewBox="${viewBox}"><use href="#${svgId}" /></svg></div>`;
    },

    formatString(str) {
      const ICONS = ['APPEAL'];
      ICONS.forEach((name) => {
        const regex = new RegExp('<' + name + ':([^>]+)>', 'g');
        str = str.replaceAll(regex, this.formatIcon(name, '<span>$1</span>'));
        str = str.replaceAll(new RegExp('<' + name + '>', 'g'), this.formatIcon(name));
      });

      const MARKERS_MAP = {
        J: 'played',
        M: 'played-from-hand',
        S: 'played-from-memory',
      };
      Object.keys(MARKERS_MAP).forEach((marker) => {
        const regex = new RegExp('{' + marker + '}', 'g');
        str = str.replace(regex, this.formatSvgIcon(MARKERS_MAP[marker]));
      });
      // str = str.replace(/__([^_]+)__/g, '<span class="action-card-name-reference">$1</span>');
      str = str.replace(/\[G\](.+)\[\/G\]/g, '<span class="rare-marker">$1</span>');
      str = str.replace(/\[\[([^\]]+)\]\]/g, '<span class="effect-reference-emphasis">$1</span>');
      str = str.replace(/\[([^\]]+)\]/g, '<span class="effect-reference">$1</span>');
      str = str.replace(/\{([0-9]+)\}/g, '<span class="mana-cost">$1</span>');

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
          }

          if (args.source !== undefined && args.sourceId !== undefined) {
            // let card = this.getCardInfos(args.card_id);
            // let uid = this.registerCustomTooltip(this.tplCard(card, true));
            // args.source = `<span class="ark-log-card-name" id="${uid}">${_(args.source)}</span>`;
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

      this._settingsModal = new customgame.modal('showSettings', {
        class: 'altered_popin',
        closeIcon: 'fa-times',
        title: _('Settings'),
        closeAction: 'hide',
        verticalAlign: 'flex-start',
        contentsTpl: `<div id='altered-settings'>
             <div id='altered-settings-header'></div>
             <div id="settings-controls-container"></div>
           </div>`,
      });

      let handWrapper = $('floating-hand-wrapper');
      $('floating-hand-button').addEventListener('click', () => {
        if (handWrapper.dataset.open && handWrapper.dataset.open == 'hand') {
          delete handWrapper.dataset.open;
        } else {
          handWrapper.dataset.open = 'hand';
        }
      });
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

    updateLayout() {
      if (!this.settings) return;
      const ROOT = document.documentElement;
    },
  });
});
