const isObject = (obj) => {
  return typeof obj === 'object' && obj !== null && !Array.isArray(obj);
};

define(['dojo', 'dojo/_base/declare', g_gamethemeurl + 'modules/js/cardsData.js'], (dojo, declare) => {
  function isVisible(elem) {
    return !!(elem.offsetWidth || elem.offsetHeight || elem.getClientRects().length);
  }

  return declare('altered.cards', null, {
    getCardInfos(cardId) {
      let card = { id: cardId };
      this.loadSaveCard(card);
      return card;
    },
    getCardName(cardId) {
      let card = this.getCardInfos(cardId);
      return this.fsr('${card_name}', { i18n: ['card_name'], card_name: _(card.name), card_id: card.id });
    },

    setupCards() {
      // This function is refreshUI compatible
      let cardIds = this.gamedatas.cards.map((card) => {
        if (!$(`card-${card.id}`)) {
          this.addCard(card);
        }

        let o = $(`card-${card.id}`);
        if (!o) return null;

        let container = this.getCardContainer(card);
        if (o.parentNode != $(container)) {
          dojo.place(o, container);
        }

        return card.id;
      });
      document.querySelectorAll('.ark-card.zoo-card').forEach((oCard) => {
        if (!cardIds.includes(oCard.getAttribute('data-id')) && !oCard.parentNode.classList.contains('player-board-hand')) {
          this.destroy(oCard);
        }
      });
    },

    /**
     * Smarter buffering of card details (to not resend them over notification again)
     */
    loadSaveCard(card) {
      let cardInfos = CARDS_DATA[card.id];
      for (let key in cardInfos) {
        card[key] = cardInfos[key];
      }
    },

    addCard(card, container = null) {
      if (card.fake) {
        this.place('tplFakeCard', card, container);
        return;
      }

      this.loadSaveCard(card);
      if (container === null) {
        container = this.getCardContainer(card);
      }

      let o = this.place('tplCard', card, container);
      if (o !== undefined) {
        console.log(card.id);
        this.addCustomTooltip(
          o.id,
          () => {
            // let status = this.getCardStatus(card.id);
            return `<div class='zoo-card-tooltip'>
                ${this.tplZooCard(card, true)}
              </div>`;
          },
          { midSize: false }
        );
      }
    },

    getCardContainer(card) {
      let t = card.location.split('_');
      if (card.location == 'hand') {
        return $(`hand-${card.pId}`);
      }

      return $('test-cards');
    },

    /**
     * Prepare cards for selection : get cards corresponding to ids,
     *   and make other in the same "location" unselectable
     */
    prepareCardsForSelection(cardIds, location = 'hand') {
      let container = null;
      if (location == 'hand') {
        this.openHand();
        container = $(`hand-${this.player_id}`);
      } else if (location == 'scoringHand') {
        this.openScoringHand();
        container = $(`scoring-hand-${this.player_id}`);
      } else if (location == 'pool') {
        container = $('cards-pool');
      } else if (location == 'choice') {
        this._cardsChoiceModal = new customgame.modal('chooseCards', {
          class: 'altered_popin',
          autoShow: true,
          closeIcon: 'fa-times',
          closeAction: 'hide',
          verticalAlign: 'flex-start',
          contentsTpl: `<div id='choose-cards'></div><div id='choose-cards-footer'></div>`,
          scale: 0.9,
          breakpoint: 800,
        });
        this.addPrimaryActionButton('btnShowCards', _('Show cards'), () => this._cardsChoiceModal.show());
        container = $('choose-cards');
      }

      let elements = {};
      cardIds.forEach((cardId) => {
        let oCard = $(`card-${cardId}`);
        if (!oCard) {
          let card = { id: cardId };
          this.loadSaveCard(card);
          this.addZooCard(card, container);
          oCard = $(`card-${cardId}`);
        }
        elements[cardId] = oCard;
        oCard.classList.remove('unselectable');
        oCard.classList.add('selectable');
      });

      let containers = [$(`hand-${this.player_id}`), $(`scoring-hand-${this.player_id}`), $('cards-pool'), $('choose-cards')];
      containers.forEach((container) => {
        if (container) {
          [...container.querySelectorAll('.ark-card:not(.unselectable):not(.selectable)')].forEach((elt) =>
            elt.classList.add('unselectable')
          );
        }
      });

      return elements;
    },

    closeChooseCardsModal() {
      if (this._cardsChoiceModal) {
        this._cardsChoiceModal.destroy();
        delete this._cardsChoiceModal;
      }
    },

    /**
     * onSelectNCards : syntaxic sugar for calling prepareCardsForSelection and then onSelectN
     *  + default behavior for keep/discard choice when selecting n/2 cards over a pool of n cards
     */
    onSelectNCards(cardIds, config, location = 'hand') {
      let elements = this.prepareCardsForSelection(cardIds, location);
      config.elements = elements;
      let callback = config.confirmMsg
        ? (selectedElements) => {
            this.askConfirmation(config.confirmMsg(selectedElements), () => config.callback(selectedElements));
          }
        : config.callback;

      if (location == 'choice') {
        config.btnContainer = 'choose-cards-footer';
      }

      this.onSelectN(config);
    },

    /**
     * Private notification for the player drawing the card :
     *  create the cards and slide them in hand
     */
    notif_pDrawCards(n) {
      debug('Notif: private drawing cards', n);
      this.closeChooseCardsModal();
      let counter = n.args.scoringCard ? 'scoringHandCount' : 'handCount';

      if (this.isFastMode()) {
        n.args.cards.forEach((card) => {
          this.addZooCard(card);
        });
        this.updateCardCosts();
        this._playerCounters[this.player_id][counter].incValue(n.args.cards.length);
        if (n.args.pilfering) this._playerCounters[n.args.pilfering][counter].incValue(-n.args.cards.length);
        return;
      }

      Promise.all(
        n.args.cards.map((card, i) => {
          return this.wait(100 * i).then(() => {
            this.addZooCard(card);

            let to = null;
            let container = this.getCardContainer(card);
            if (!isVisible(container)) to = $('floating-hand-button');
            let source = n.args.pilfering ? $(`counter-${n.args.pilfering}-${counter}`) : this.getVisibleTitleContainer();

            return this.slide(`card-${card.id}`, container, {
              from: source,
              duration: 1000,
              to,
            });
          });
        })
      ).then(() => {
        this._playerCounters[this.player_id][counter].incValue(n.args.cards.length);
        if (n.args.pilfering) this._playerCounters[n.args.pilfering][counter].incValue(-n.args.cards.length);

        this.updateCardCosts();
        this.notifqueue.setSynchronousDuration(100);
      });
    },

    /**
     * Public notification when drawing cards:
     *  ignore if current player is the one drawing card
     *  slide fakes cards from titlebar to player panel and increase hand count
     */
    notif_drawCards(n) {
      debug('Notif: public drawing cards', n);
      this.closeChooseCardsModal();
      let counter = n.args.scoringCard ? 'scoringHandCount' : 'handCount';

      let nCards = n.args.n;
      if (this.isFastMode()) {
        this._playerCounters[this.player_id][counter].incValue(nCards);
        return;
      }

      Promise.all(
        Array.from(Array(nCards), (x, i) => i).map((i) => {
          return this.wait(100 * i).then(() => {
            this.addZooCard({ id: i, fake: true }, this.getVisibleTitleContainer());
            return this.slide(`card-${i}`, `counter-${n.args.player_id}-${counter}`, {
              duration: 1000,
              destroy: true,
              phantom: false,
            });
          });
        })
      ).then(() => {
        this._playerCounters[n.args.player_id][counter].incValue(nCards);
        this.notifqueue.setSynchronousDuration(100);
      });
    },

    /**
     * Private notification for the player discarding the card :
     *  slide them and destroy them
     */
    notif_pDiscardCards(n) {
      debug('Notif: private discarding cards', n);
      let counter = n.args.scoringCard ? 'scoringHandCount' : 'handCount';

      if (this.isFastMode()) {
        n.args.cards.forEach((card) => {
          this.destroy($(`card-${card.id}`));
        });
        this._playerCounters[this.player_id][counter].incValue(-n.args.cards.length);
        if (n.args.pilfering) this._playerCounters[n.args.pilfering][counter].incValue(n.args.cards.length);
        if (n.args.bonuses) this.notif_getBonuses(n);
        return;
      }

      Promise.all(
        n.args.cards.map((card, i) => {
          let target = n.args.pilfering ? $(`counter-${n.args.pilfering}-${counter}`) : this.getVisibleTitleContainer();
          return this.slide(`card-${card.id}`, target, {
            delay: 100 * i,
            duration: 1000,
            destroy: true,
            phantom: false,
          });
        })
      ).then(() => {
        this._playerCounters[this.player_id][counter].incValue(-n.args.cards.length);
        if (n.args.pilfering) this._playerCounters[n.args.pilfering][counter].incValue(n.args.cards.length);

        if (n.args.bonuses) {
          this.notif_getBonuses(n);
        } else {
          this.notifqueue.setSynchronousDuration(100);
        }
      });
    },

    /**
     * Public notification when discarding cards:
     *  ignore if current player is the one discarding card
     *  slide fakes cards from player panel to titlebar and decrease hand count
     */
    notif_discardCards(n) {
      debug('Notif: public discarding cards', n);
      if (n.args.player_id == this.player_id) {
        return;
      }

      let counter = n.args.scoringCard ? 'scoringHandCount' : 'handCount';
      let nCards = n.args.n;
      if (this.isFastMode()) {
        this._playerCounters[n.args.player_id][counter].incValue(-nCards);
        if (n.args.bonuses) this.notif_getBonuses(n);
        return;
      }

      Promise.all(
        Array.from(Array(nCards), (x, i) => i).map((i) => {
          return this.wait(100 * i).then(() => {
            this.addZooCard({ id: i, fake: true }, `counter-${n.args.player_id}-${counter}`);
            return this.slide(`card-${i}`, this.getVisibleTitleContainer(), {
              duration: 1000,
              destroy: true,
              phantom: false,
            });
          });
        })
      ).then(() => {
        this._playerCounters[n.args.player_id][counter].incValue(-nCards);
        if (n.args.bonuses) {
          this.notif_getBonuses(n);
        } else {
          this.notifqueue.setSynchronousDuration(200);
        }
      });
    },

    /**
     * pilferingCard : slighty different => move card to other player panel and destroy it
     */
    notif_pilferingCard(n) {
      if (n.args.player_id == this.player_id || n.args.player_id2 == this.player_id) {
        return;
      }

      let counter = 'handCount';
      let nCards = 1;
      if (this.isFastMode()) {
        this._playerCounters[n.args.player_id][counter].incValue(-nCards);
        this._playerCounters[n.args.player_id2][counter].incValue(nCards);
        return;
      }

      this.addZooCard({ id: 1, fake: true }, `counter-${n.args.player_id}-${counter}`);
      this.slide(`card-1`, `counter-${n.args.player_id2}-${counter}`, {
        duration: 1000,
        destroy: true,
        phantom: false,
      }).then(() => {
        this._playerCounters[n.args.player_id][counter].incValue(-nCards);
        this._playerCounters[n.args.player_id2][counter].incValue(nCards);
        this.notifqueue.setSynchronousDuration(200);
      });
    },

    //////////////////////////////////////////////
    //  _____ ____  _
    // |_   _|  _ \| |
    //   | | | |_) | |
    //   | | |  __/| |___
    //   |_| |_|   |_____|
    //////////////////////////////////////////////

    tplFakeCard(card) {
      let uid = 'card-' + card.id;
      return `<div id="${uid}" class='ark-card zoo-card fake-card'>
        <div class='ark-card-wrapper'></div>
      </div>`;
    },

    tplCard(card, tooltip = false) {
      let uid = (tooltip ? 'tooltip_card-' : 'card-') + card.id;

      return `<div id="${uid}" data-id='${card.id}' class='altered-card ${tooltip ? 'tooltip' : ''}'>
        <div class='altered-card-wrapper'>
          ${card.name}
        </div>
      </div>`;
    },

    getAbilityDesc(ability, n, card) {
      let descs = {};

      let desc = descs[ability];
      let result = {
        title: desc[0],
        desc: n == 1 && desc.length > 2 ? desc[2] : desc[1],
      };

      if (n !== null) {
        result.title = this.fsr(result.title, { i18n: ['n'], n });
        result.desc = this.fsr(result.desc, { i18n: ['n'], n, icon: this.formatIcon(`action-card-${n}`) });
      } else {
        result.desc = this.formatString(result.desc);
      }
      return result;
    },

    notif_buyAnimal(n) {
      debug('Notif: buying an animal', n);

      // Pay appeal in case of release
      if (n.args.release) {
        this.animatePlayerCounter(n.args.player_id, 'appeal', -n.args.amount);
      }
      // Or pay money in case of buy
      else {
        this.animatePlayerCounter(n.args.player_id, 'money', -n.args.amount);
      }

      // Slide the card
      let id = `card-${n.args.card.id}`;
      if (!$(id)) {
        this.addZooCard(n.args.card, 'page-title');
      }
      let container = this.getCardContainer(n.args.card);
      let config = {};
      if (!isVisible(container)) config.to = $(`overall_player_board_${n.args.card.pId}`);
      this.slide(id, container, config);
      if (!n.args.fromDisplay) {
        this._playerCounters[n.args.player_id]['handCount'].incValue(-1);
      }

      // Update enclosure
      let building = n.args.building;
      if (building) {
        let buildingId = `building-${building.id}`;
        $(buildingId).dataset.state = building.state;
      }

      // Update icons summaries
      this.gamedatas.players[n.args.player_id].icons = n.args.icons;
      this.updatePlayersIconsSummaries();
    },
  });
});
