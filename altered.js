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
  'ebg/core/gamegui',
  'ebg/counter',
  g_gamethemeurl + 'modules/js/Core/game.js',
  g_gamethemeurl + 'modules/js/Core/modal.js',
], function (dojo, declare, Sortable) {
  return declare('bgagame.altered', ebg.core.gamegui, {
    constructor: function () {
      this._activeStates = [];
      this._notifications = [
        ['clearTurn', 200],
        ['refreshUI', 200],
        ['refreshHand', 200],
        ['pDiscardMana', null],
        ['discardMana', null, (notif) => notif.args.player_id == this.player_id],
        ['pMoveToHand', null],
        ['moveToHand', null, (notif) => notif.args.player_id == this.player_id],
        ['payMana', 500],
      ];

      // Fix mobile viewport (remove CSS zoom)
      this.default_viewport = 'width=740';
      this.cardStatuses = {};
    },

    setup: function (gamedatas) {
      console.log('Starting game setup');
      debug(gamedatas);

      // Setting up player boards
      for (var player_id in gamedatas.players) {
        var player = gamedatas.players[player_id];

        // TODO: Setting up players boards if needed
      }

      // TODO: Set up your game interface here, according to "gamedatas"

      // Setup game notifications to handle (see "setupNotifications" method below)
      // this.setupNotifications();

      console.log('Ending game setup');
    },

    ///////////////////////////////////////////////////
    //// Game & client states

    // onEnteringState: this method is called each time we are entering into a new game state.
    //                  You can use this method to perform some user interface changes at this moment.
    //
    // onEnteringState: function (stateName, args) {
    //   debug('Entering state: ' + stateName, args);

    //   switch (stateName) {
    //     /* Example:

    //         case 'myGameState':

    //             // Show some HTML block at this game state
    //             dojo.style( 'my_html_block_id', 'display', 'block' );

    //             break;
    //        */

    //     case 'dummmy':
    //       break;
    //   }
    // },

    // onLeavingState: this method is called each time we are leaving a game state.
    //                 You can use this method to perform some user interface changes at this moment.
    //
    // onLeavingState: function (stateName) {
    //   console.log('Leaving state: ' + stateName);

    //   switch (stateName) {
    //     /* Example:

    //         case 'myGameState':

    //             // Hide the HTML block we are displaying only during this game state
    //             dojo.style( 'my_html_block_id', 'display', 'none' );

    //             break;
    //        */

    //     case 'dummmy':
    //       break;
    //   }
    // },

    // onUpdateActionButtons: in this method you can manage "action buttons" that are displayed in the
    //                        action status bar (ie: the HTML links in the status bar).
    //
    //     onUpdateActionButtons: function (stateName, args) {
    //       console.log('onUpdateActionButtons: ' + stateName);

    //       if (this.isCurrentPlayerActive()) {
    //         switch (
    //           stateName
    //           /*
    //                  Example:

    //                  case 'myGameState':

    //                     // Add 3 action buttons in the action status bar:

    //                     this.addActionButton( 'button_1_id', _('Button 1 label'), 'onMyMethodToCall1' );
    //                     this.addActionButton( 'button_2_id', _('Button 2 label'), 'onMyMethodToCall2' );
    //                     this.addActionButton( 'button_3_id', _('Button 3 label'), 'onMyMethodToCall3' );
    //                     break;
    // */
    //         ) {
    //         }
    //       }
    // },
  });
});
