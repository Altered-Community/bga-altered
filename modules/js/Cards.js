define(['dojo', 'dojo/_base/declare', g_gamethemeurl + 'modules/js/cardsData.js'], (dojo, declare) => {
  function isVisible(elem) {
    return !!(elem.offsetWidth || elem.offsetHeight || elem.getClientRects().length);
  }

  const isObject = (obj) => {
    return typeof obj === 'object' && obj !== null && !Array.isArray(obj);
  };

  const HERO = 'hero';
  const CHARACTER = 'character';
  const PERMANENT = 'permanent';
  const SPELL = 'spell';
  const TOKEN = 'token';
  const FONT_SIZE = '13px';

  return declare('altered.cards', null, {
    // getCardInfos(cardId) {
    //   let card = { id: cardId };
    //   this.loadSaveCard(card);
    //   return card;
    // },
    // getCardName(cardId) {
    //   let card = this.getCardInfos(cardId);
    //   return this.fsr('${card_name}', { i18n: ['card_name'], card_name: _(card.name), card_id: card.id });
    // },

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

        // Update tapped state
        o.classList.toggle('tapped', card.properties && card.properties.tapped == true);

        // Minimize card except in hand and in discard
        let isFull =
          container.classList.contains('player-hand') ||
          container.classList.contains('player-board-discard') ||
          container.classList.contains('mana-modal');
        o.classList.toggle('mini-card', !isFull);

        return card.id;
      });
      document.querySelectorAll('.altered-card').forEach((oCard) => {
        if (!cardIds.includes(parseInt(oCard.getAttribute('data-id'))) && !oCard.classList.contains('card-back')) {
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

      // this.loadSaveCard(card);
      if (container === null) {
        container = this.getCardContainer(card);
      }

      let o = this.place('tplCard', card, container);
      if (o !== undefined) {
        this.addCustomTooltip(o.id, () => this.tplCardTooltip(card), { midSize: false });
        this.autofitCardFrame(o);
      }
    },

    addFakeCard(container) {
      let id = this._fakeIndex++;
      container.insertAdjacentHTML(
        'beforeend',
        `<div id='card-f-${id}' class='altered-card card-back'>
          <div class='altered-card-wrapper' data-asset='back'></div>
        </div>`
      );
      return `card-f-${id}`;
    },

    getCardContainer(card) {
      let t = card.location.split('_');
      let type = card.properties.type;
      if (card.location == 'hand') {
        return $(`hand-${card.pId}`);
      } else if (['stormLeft', 'stormRight', 'reserve', 'permanent', 'limbo', 'discard'].includes(card.location)) {
        return $(`board-${card.location}-${card.pId}`);
      }
      // TODO REMOVE : legacy code
      else if (card.location == 'reserve') {
        return $(`board-reserve-${card.pId}`);
      } else if (type == HERO) {
        return $(card.location);
      } else if (card.location == 'mana') {
        return $(`mana-cards-${card.pId}`);
      }

      return $('test-cards');
    },

    setupDiscardModal(player) {
      let pId = player.id;
      this._discardModals[pId] = new customgame.modal('discardDisplay' + pId, {
        class: 'altered_discard_popin',
        autoShow: false,
        closeIcon: null,
        closeAction: 'hide',
        title: this.fsr(_('Discard of ${player_name}'), { player_name: player.name }),
        verticalAlign: 'flex-start',
        contentsTpl: `<div class='discard-modal' id='discard-cards-${pId}'></div>`,
        scale: 0.9,
        breakpoint: 800,
        onStartShow: () => $(`discard-cards-${pId}`).insertAdjacentElement('beforeend', $(`board-discard-${pId}`)),
        onStartHide: () => $(`player-board-${pId}`).insertAdjacentElement('beforeend', $(`board-discard-${pId}`)),
        onShow: () => this.closeCurrentTooltip(),
      });
      $(`board-discard-${pId}`).addEventListener('click', () => {
        this.closeCurrentTooltip();
        if (this._discardModals[pId].isDisplayed()) this._discardModals[pId].hide();
        else this._discardModals[pId].show();
      });
    },

    setupManaModal(player) {
      let pId = player.id;
      this._manaModal = new customgame.modal('manaDisplay', {
        class: 'altered_mana_popin',
        autoShow: false,
        closeIcon: null,
        closeAction: 'hide',
        title: _('Your mana cards'),
        verticalAlign: 'flex-start',
        contentsTpl: `<div class='mana-modal' id='mana-cards-${pId}'></div>`,
        scale: 0.9,
        breakpoint: 800,
        onShow: () => this.closeCurrentTooltip(),
      });
      $(`mana-gauge-${pId}`).addEventListener('click', () => {
        this.closeCurrentTooltip();
        if (this._manaModal.isDisplayed()) this._manaModal.hide();
        else this._manaModal.show();
      });
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
          console.error(cardId);
          let card = { id: cardId };
          // this.loadSaveCard(card);
          // this.addZooCard(card, container);
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
      debug(elements);
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

    onEnteringStateDiscard(args) {
      if (args.descSuffix == 'nightCleanUp') {
        this.onEnteringStateNightDiscard(args);
        return;
      }
      this.onSelectNCards(args._private.cards, {
        n: args.n,
        class: 'selectable',
        confirmText: _('Confirm discard'),
        callback: (selectedElements, ignoredElements) => this.takeAtomicAction('actDiscard', [selectedElements]),
      });
    },

    onEnteringStateNightDiscard(args) {
      this.onSelectNCards(args._private.cards, {
        n: args.n + (args.nPermanents ?? 0),
        class: 'selectable',
        confirmText: _('Confirm discard'),
        updateCallback: (cIds) => {
          // TODO
          // debug(cIds);
          // if ($('btnConfirmChoice')) $('btnConfirmChoice').remove();
          // if (cIds.length > 0) {
          //   let totalCost = cIds.reduce((carry, cId) => carry + args.costs[cId], 0);
          //   if (totalCost <= args.n) {
          //     this.addPrimaryActionButton(
          //       'btnConfirmChoice',
          //       this.fsr(_('Confirm (total: ${totalCost} energy)'), { totalCost }),
          //       () => this.takeAtomicAction('actFulfillContractSimone', [cIds])
          //     );
          //   }
          // }
        },
        callback: (selectedElements, ignoredElements) => this.takeAtomicAction('actDiscard', [selectedElements]),
      });
    },

    /**
     * Private notification for the player drawing the card :
     *  create the cards and slide them in hand
     */
    notif_pDrawCards(n) {
      debug('Notif: private drawing cards', n);
      // this.closeChooseCardsModal();
      let counter = 'handCount';

      this._playerCounters[this.player_id]['deckCount'].incValue(-n.args.cards.length);
      if (this.isFastMode()) {
        n.args.cards.forEach((card) => {
          this.addCard(card);
        });
        this._playerCounters[this.player_id][counter].incValue(n.args.cards.length);
        if (n.args.stealing) this._playerCounters[n.args.stealing][counter].incValue(-n.args.cards.length);
        return;
      }

      Promise.all(
        n.args.cards.map((card, i) => {
          return this.wait(100 * i).then(() => {
            this.addCard(card);

            let to = null;
            let container = this.getCardContainer(card);
            if (!isVisible(container)) to = $('floating-hand-button');
            let source = n.args.stealing ? $(`counter-${n.args.stealing}-${counter}`) : $(`board-deck-${this.player_id}`);

            return this.slide(`card-${card.id}`, container, {
              from: source,
              duration: 1000,
              to,
            });
          });
        })
      ).then(() => {
        this._playerCounters[this.player_id][counter].incValue(n.args.cards.length);
        if (n.args.stealing) this._playerCounters[n.args.stealing][counter].incValue(-n.args.cards.length);

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
      // this.closeChooseCardsModal();
      let counter = 'handCount';

      let nCards = n.args.n;
      this._playerCounters[n.args.player_id]['deckCount'].incValue(-nCards);
      if (this.isFastMode()) {
        this._playerCounters[n.args.player_id][counter].incValue(nCards);
        return;
      }

      Promise.all(
        Array.from(Array(nCards), (x, i) => i).map((i) => {
          return this.wait(100 * i).then(() => {
            let cardId = this.addFakeCard($(`board-deck-${n.args.player_id}`));
            return this.slide(cardId, `hand-${n.args.player_id}`, {
              duration: 1000,
              phantom: false,
            });
          });
        })
      ).then(() => {
        this._playerCounters[n.args.player_id][counter].incValue(nCards);
        this.notifqueue.setSynchronousDuration(100);
      });
    },

    notif_publicDrawCards(n) {
      debug('Notif: public drawing cards', n);
      // this.closeChooseCardsModal();
      let counter = 'handCount';

      this._playerCounters[n.args.player_id]['deckCount'].incValue(-n.args.cards.length);
      if (this.isFastMode()) {
        n.args.cards.forEach((card) => {
          this.addCard(card);
        });
        this._playerCounters[n.args.player_id][counter].incValue(n.args.cards.length);
        if (n.args.stealing) this._playerCounters[n.args.stealing][counter].incValue(-n.args.cards.length);
        return;
      }

      Promise.all(
        n.args.cards.map((card, i) => {
          return this.wait(100 * i).then(() => {
            this.addCard(card);

            let to = null;
            let container = this.getCardContainer(card);
            if (!isVisible(container)) to = $('floating-hand-button');
            let source = n.args.stealing ? $(`counter-${n.args.stealing}-${counter}`) : $(`board-deck-${n.args.player_id}`);

            return this.slide(`card-${card.id}`, container, {
              from: source,
              duration: 1000,
              to,
            });
          });
        })
      ).then(() => {
        this._playerCounters[n.args.player_id][counter].incValue(n.args.cards.length);
        if (n.args.stealing) this._playerCounters[n.args.stealing][counter].incValue(-n.args.cards.length);

        this.notifqueue.setSynchronousDuration(100);
      });
    },

    /**
     * Private notification for the player discarding the card :
     *  slide them and destroy them
     */
    notif_pDiscardCards(n) {
      debug('Notif: private discarding cards', n);
      let counter = 'handCount';

      if (this.isFastMode()) {
        n.args.cards.forEach((card) => {
          this.destroy($(`card-${card.id}`));
        });
        this._playerCounters[this.player_id][counter].incValue(-n.args.cards.length);
        if (n.args.stealing) this._playerCounters[n.args.stealing][counter].incValue(n.args.cards.length);
        if (n.args.toMana) {
          this._playerCounters[this.player_id]['totalMana'].incValue(n.args.cards.length);
          this._playerCounters[this.player_id]['mana'].incValue(n.args.cards.length);
        }
        return;
      }

      Promise.all(
        n.args.cards.map((card, i) => {
          // TO MANA
          if (n.args.toMana) {
            let target = $(`counter-board-${this.player_id}-mana`);
            let oCard = $(`card-${card.id}`);
            let fakeCardId = this._fakeIndex++;
            let fakeCard = this.tplFakeCard({ id: fakeCardId });
            return this.flipAndReplace(oCard, fakeCard)
              .then(() =>
                this.slide(`card-${fakeCardId}`, target, {
                  delay: 100 * i,
                  duration: 1000,
                  destroy: true,
                  phantom: false,
                })
              )
              .then(() => $(`mana-cards-${this.player_id}`).insertAdjacentElement('beforeend', oCard));
          }
          // NORMAL
          else {
            let target = n.args.stealing ? $(`counter-${n.args.stealing}-${counter}`) : this.getVisibleTitleContainer();
            return this.slide(`card-${card.id}`, target, {
              delay: 100 * i,
              duration: 1000,
              destroy: true,
              phantom: false,
            });
          }
        })
      ).then(() => {
        this._playerCounters[this.player_id][counter].incValue(-n.args.cards.length);
        if (n.args.stealing) this._playerCounters[n.args.stealing][counter].incValue(n.args.cards.length);
        if (n.args.toMana) {
          this._playerCounters[this.player_id]['totalMana'].incValue(n.args.cards.length);
          this._playerCounters[this.player_id]['mana'].incValue(n.args.cards.length);
        }

        this.notifqueue.setSynchronousDuration(100);
      });
    },

    /**
     * Public notification when discarding cards:
     *  ignore if current player is the one discarding card
     *  slide fakes cards from player panel to titlebar and decrease hand count
     * NOT USED
     */
    notif_discardCards(n) {
      debug('Notif: public discarding cards', n);
      if (n.args.player_id == this.player_id) {
        return;
      }

      let counter = 'handCount';
      let nCards = n.args.n;
      if (this.isFastMode()) {
        this._playerCounters[n.args.player_id][counter].incValue(-nCards);
        if (n.args.toMana) {
          this._playerCounters[this.player_id]['totalMana'].incValue(nCards);
          this._playerCounters[this.player_id]['mana'].incValue(nCards);
        }
        return;
      }

      let oCards = [...$(`hand-${n.args.player_id}`).querySelectorAll('.altered-card')];
      Promise.all(
        Array.from(Array(nCards), (x, i) => i).map((i) => {
          return this.wait(100 * i).then(() => {
            return this.slide(
              oCards[i].id,
              n.args.toMana ? $(`counter-board-${n.args.player_id}-mana`) : this.getVisibleTitleContainer(),
              {
                duration: 1000,
                destroy: true,
                phantom: false,
              }
            );
          });
        })
      ).then(() => {
        this._playerCounters[n.args.player_id][counter].incValue(-nCards);
        if (n.args.toMana) {
          this._playerCounters[n.args.player_id]['totalMana'].incValue(nCards);
          this._playerCounters[n.args.player_id]['mana'].incValue(nCards);
        }

        this.notifqueue.setSynchronousDuration(200);
      });
    },

    notif_publicDiscard(n) {
      debug('Public discard', n);
      let pId = n.args.player_id;

      Promise.all(
        [...n.args.cards].map((card, i) => {
          return this.wait(200 * i).then(() => {
            if (card.location == 'hand') return;
            if (n.args.hand == true) this._playerCounters[n.args.player_id]['handCount'].incValue(-1);

            let elt = $(`card-${card.id}`);
            if (card.location == 'discard') elt.classList.remove('mini-card');
            this.updateStatusIfCard(elt);
            return this.slide(`card-${card.id}`, `board-${card.location}-${card.pId}`);
          });
        })
      ).then(() => {
        this.notifqueue.setSynchronousDuration(100);
      });
    },

    /**
     * stealingCard : slighty different => move card to other player panel and destroy it
     */
    notif_stealingCard(n) {
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

      this.addCard({ id: 1, fake: true }, `counter-${n.args.player_id}-${counter}`);
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

    /**
     * Public notification when discarding cards from the display
     *
    notif_discardCardsOnDisplay(n) {
      debug('Notif: discarding cards on the display', n);

      // Remove tokens on the card
      if (n.args.tokenIds) {
        n.args.tokenIds.forEach((mId) => {
          $(`meeple-${mId}`).remove();
        });
      }

      if (this.isFastMode()) {
        n.args.cards.forEach((card) => {
          this.destroy($(`card-${card.id}`));
        });
        return;
      }

      Promise.all(
        n.args.cards.map((card, i) => {
          return this.slide(`card-${card.id}`, this.getVisibleTitleContainer(), {
            delay: 100 * i,
            duration: 1000,
            destroy: true,
            phantom: false,
          });
        })
      ).then(() => {
        this.notifqueue.setSynchronousDuration(100);
      });
    },
    */

    notif_playCard(n) {
      debug('Notif: playing a card', n);
      // Update counters
      if (n.args.fromLocation == 'hand') {
        this._playerCounters[n.args.player_id]['handCount'].incValue(-1);
      }
      this._playerCounters[n.args.player_id]['mana'].toValue(n.args.mana);
      this._playerCounters[n.args.player_id]['totalMana'].toValue(n.args.totalMana);

      // Slide the card
      let card = n.args.card;
      let id = `card-${card.id}`;
      let slideIt = () => {
        $(id).classList.add('mini-card');
        let highlight = n.args.player_id == this.bottomPId ? 'highlighted-me' : 'highlighted-opponent';
        $(id).classList.add(highlight);
        let container = this.getCardContainer(card);
        this.slide(id, container).then(() => {
          this.updateBiomeTotals(card.pId, n.args.biomes);
          $(id).classList.remove(highlight);
          this.updateMovements(n.args.movements);
          this.notifqueue.setSynchronousDuration(100);
        });
      };

      if (!$(id)) {
        let fakeCard = $(`hand-${n.args.player_id}`).querySelector('.card-back:last-child');
        this.addCard(card, `hand-${n.args.player_id}`);
        this.flipAndReplace(fakeCard, id).then(slideIt);
      } else {
        slideIt();
      }
    },

    notif_supportEffect(n) {
      debug('Notif : playing from support');
      let card = n.args.card;
      let id = `card-${card.id}`;
      if (!$(id)) {
        this.addCard(card, 'page-title');
      }
      let container = this.getCardContainer(card);
      $(id).classList.remove('mini-card');

      this.slide(id, container).then(() => {
        this.notifqueue.setSynchronousDuration(100);
      });
    },

    notif_tap(n) {
      debug('Notif: tapping card', n);
      $(`card-${n.args.card.id}`).classList.remove('selectable');
      $(`card-${n.args.card.id}`).classList.add('tapped');
    },

    notif_untap(n) {
      debug('Notif: untapping card(s)', n);
      n.args.cardIds.forEach((cardId) => {
        if ($(`card-${cardId}`)) $(`card-${cardId}`).classList.remove('tapped');
      });
    },

    notif_shuffleDeck(n) {
      debug('Notif: shuffling deck', n);
      this._playerCounters[n.args.player_id]['deckCount'].incValue(n.args.n);
    },

    notif_spellCleanup(n) {
      debug('Notif: spell cleanup', n);
      n.args.deleted.forEach((meepleId) => {
        $(`meeple-${meepleId}`).remove();
      });

      // Slide the card
      let card = n.args.card;
      this.updateCardStatuses(card.id);
      let id = `card-${card.id}`;
      if (!$(id)) {
        this.addCard(card, 'page-title');
      }
      if (card.location == 'discard') {
        $(id).classList.remove('mini-card');
      }
      let container = this.getCardContainer(card);
      this.slide(id, container).then(() => {
        this.notifqueue.setSynchronousDuration(100);
      });
    },

    notif_invokeToken(n) {
      debug('Notif: invoke token', n);
      // Slide the card
      let card = n.args.card;
      let id = `card-${card.id}`;
      // we slide it from the card triggering the effect
      if (!$(id)) {
        this.addCard(card, n.args.card2.location == 'hand' ? 'page-title' : `card-${n.args.card2.id}`);
        $(id).classList.add('mini-card');
      }
      let container = this.getCardContainer(card);
      this.slide(id, container).then(() => {
        this.updateBiomeTotals(card.pId, n.args.biomes);
        this.notifqueue.setSynchronousDuration(100);
      });
    },

    notif_nightCleanup(n) {
      debug('Notif: cleaning up played cards', n);
      let pId = n.args.player_id;
      n.args.cards.forEach((card) => (card.discard = true));

      n.args.meeples.forEach((meepleId) => {
        $(`meeple-${meepleId}`).remove();
      });

      Promise.all(
        [...n.args.cards, ...n.args.cards2].map((card, i) => {
          return this.wait(200 * i).then(() => {
            this.updateCardStatuses(card.id);
            return this.slide(`card-${card.id}`, card.discard ? `board-discard-${pId}` : `board-reserve-${pId}`).then(() => {
              if (card.discard) $(`card-${card.id}`).classList.remove('mini-card');
            });
          });
        })
      )
        .then(
          Promise.all(
            [...n.args.cards3].map((card, i) => {
              return this.wait(200 * i).then(() => {
                return $(`card-${card.id}`).remove();
              });
            })
          )
        )
        .then(() => {
          this.notifqueue.setSynchronousDuration(100);
        });
    },

    notif_cleanupCards(n) {
      debug('Notif: updating status of all cleaned up cards', n);
      Promise.all(
        [...n.args.cardIds].map((cardId, i) => {
          return this.wait(200 * i).then(() => {
            this.updateCardStatuses(cardId);
          });
        })
      ).then(() => {
        this.notifqueue.setSynchronousDuration(100);
      });
      this.gamedatas.passedPlayers = [];
    },

    /**
     * Public notification when someone take back a card in hand
     *  slide it to hand if current player
     *  slide it to player panel otherwise
     *  inc hand count
     *  multiple cards of multiple players can be moved like that
     */
    notif_moveToHand(n) {
      debug('Moving cards to hand', n);
      player_inc = {};
      Promise.all(
        [...n.args.cards].map((card) => {
          isPlayer = this.player_id == card.pId;
          this.updateCardStatuses(card.id);
          player_inc[card.pId] = player_inc[card.pId] ?? 0 + 1;

          return this.slide(`card-${card.id}`, isPlayer ? this.getCardContainer(card) : `counter-${card.pId}-handCount`, {
            duration: 1000,
            destroy: isPlayer ? false : true,
            phantom: isPlayer ? true : false,
          });
        })
      )
        .then(() => {
          Object.keys(player_inc).forEach((player) => {
            this._playerCounters[player]['handCount'].incValue(player_inc[player]);
          });
        })
        .then(() => {
          this.notifqueue.setSynchronousDuration(100);
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
      return `<div id="${uid}" class='altered-card fake-card'>
        <div class='altered-card-wrapper' data-asset='back'>
        </div>
      </div>`;
    },

    tplCard(card) {
      let type = card.properties.type;
      let miniZones = ['reserve', 'stormLeft', 'stormRight', 'permanent'];
      let mini = miniZones.includes(card.location);
      if (type == HERO) {
        return this.tplHeroCard(card);
      } else if (type == CHARACTER) {
        return this.tplCharacterCard(card, false, mini);
      } else if (type == SPELL) {
        return this.tplSpellCard(card, false, mini);
      } else if (type == PERMANENT) {
        return this.tplPermanentCard(card, false, mini);
      } else if (type == TOKEN) {
        return this.tplTokenCard(card, false, mini);
      }

      console.error('No tpl yet', card);
      return '';
    },

    tplCardTooltip(card) {
      let type = card.properties.type;
      if (type == HERO) {
        return this.tplHeroCardTooltip(card);
      } else if (type == CHARACTER) {
        if (card.properties.token) return this.tplTokenCardTooltip(card);
        else return this.tplCharacterCardTooltip(card);
      } else if (type == SPELL) {
        return this.tplSpellCardTooltip(card);
      } else if (type == PERMANENT) {
        return this.tplPermanentCardTooltip(card);
      } else if (type == TOKEN) {
        return this.tplTokenCardTooltip(card);
      }

      return '';
    },

    tplHeroCard(card, tooltip = false, mini = false) {
      let p = card.properties;
      return `<div id="card-${card.id}${tooltip ? 'tooltip' : ''}" data-id="${card.id}" 
          class='altered-card card-hero ${mini ? 'mini-card' : ''} '>
        <div class='altered-card-wrapper' data-asset='${p.asset}'>
          <div class='card-frame' data-faction='${p.faction}' data-type='hero'></div>
          <div class='card-name'>${_(p.name)}</div>
          <div class='card-typeline'>${_(p.typeline)}</div>

          <div class='card-text'>
            <div class='card-qrcode-container'>
              <a href="https://www.equinox-ccg.io/fr-fr/cards/${p.uid}" target="_blank" class='card-qrcode'></a>
            </div>
            <div class='card-effect'>
              ${this.formatString(_(p.effectDesc || ''))}
            </div>
            <div class='card-reminders'>
            ${p.reminders ? this.formatString(_(p.reminders)) : ''}
            </div>
          </div>
        </div>
      </div>`;
    },
    tplHeroCardTooltip(card) {
      return `<div id="card-${card.id}-tooltip" class='altered-card-tooltip'>
        ${this.tplHeroCard(card, true, false)}
        <div class='tooltip-explanation'>${this.getCardTooltipExplanation(card)}</div>
      </div>`;
    },

    getBiomesUISizes(p) {
      let biomes = [p.forest, p.mountain, p.ocean];
      biomes.sort();
      let mid = biomes[1];
      if (mid == 0) mid = biomes[2];

      let sizes = {};
      ['forest', 'mountain', 'ocean'].forEach((biome) => {
        let v = p[biome];
        let size = null;
        if (v == 0) size = 0;
        else if (v < mid) size = 1;
        else if (v == mid) size = 2;
        else if (v > mid) size = 3;
        sizes[biome] = size;
      });

      return sizes;
    },

    tplCharacterCard(card, tooltip = false, mini = false) {
      let p = card.properties;
      let sizes = this.getBiomesUISizes(p);
      let frameSize = tooltip ? $(`card-${card.id}`).querySelector('.card-frame').dataset.size : 1;
      let textFontSize = tooltip ? $(`card-${card.id}`).querySelector('.card-text').style.fontSize : FONT_SIZE;

      let changed = (name) => (p.changedStats && p.changedStats.includes(name) ? ' altered' : '');
      return `<div id="card-${card.id}${tooltip ? 'tooltip' : ''}" data-id="${card.id}" 
        class='altered-card card-character ${mini ? 'mini-card' : ''}'>
        <div class='altered-card-wrapper' data-asset='${p.asset}'>
          <div class='card-frame' data-size='${frameSize}' data-faction='${p.faction}' 
              data-rarity='${p.rarity}' data-support='${p.supportDesc ? 1 : 0}' data-type='character'></div>
          <div class='rarity-gem' data-rarity='${p.rarity}'></div>
          <div class='card-hand-cost ${changed('costHand')}'>${p.costHand}</div>
          <div class='card-reserve-cost ${changed('costReserve')}'>${p.costReserve}</div>
          <div class='card-costs-bg' data-faction='${p.faction}'></div>

          <div class='card-name'>${_(p.name)}</div>
          <div class='card-typeline'>${_(p.typeline)}</div>

          <div class='card-forest ${changed('forest')}' data-size='${sizes.forest}' data-initial='${p.forest}'>
            ${p.forest}
          </div>
          <div class='card-mountain ${changed('mountain')}' data-size='${sizes.mountain}' data-initial='${p.mountain}'>
            ${p.mountain}
          </div>
          <div class='card-ocean ${changed('ocean')}' data-size='${sizes.ocean}' data-initial='${p.ocean}'>
            ${p.ocean}
          </div>

          <div class='card-text' style="font-size:${textFontSize}">
            <div class='card-qrcode-container'>
              <a href="https://www.equinox-ccg.io/fr-fr/cards/${p.uid}" target="_blank" class='card-qrcode'></a>
            </div>
            <div class='card-effect'>
              ${this.formatString(_(p.effectDesc) || '')}
            </div>
            <div class='card-reminders'>
              ${p.reminders ? this.formatString(_(p.reminders)) : ''}
            </div>
          </div>
          <div class='card-support'>
            ${p.supportDesc ? this.formatString(_(p.supportDesc)) : ''}
          </div>
        </div>

        <div class='altered-card-statuses'></div>
      </div>`;
    },
    tplCharacterCardTooltip(card) {
      return `<div id="card-${card.id}-tooltip" class='altered-card-tooltip'>
        ${this.tplCharacterCard(card, true, false)}
        <div class='tooltip-explanation'>${this.getCardTooltipExplanation(card)}</div>
      </div>`;
    },

    tplTokenCard(card, tooltip = false, mini = false) {
      let p = card.properties;
      let sizes = this.getBiomesUISizes(p);
      return `<div id="card-${card.id}${tooltip ? 'tooltip' : ''}" data-id="${card.id}" 
        class='altered-card card-token ${mini ? 'mini-card' : ''}'>
        <div class='altered-card-wrapper' data-asset='${p.asset}'>
          <div class='card-frame' data-faction='${p.faction}' data-type='token'></div>
          <div class='card-name'>${_(p.name)}</div>
          <div class='card-typeline'>${_(p.typeline)}</div>

          <div class='card-forest' data-size='${sizes.forest}' data-initial='${p.forest}'>${p.forest}</div>
          <div class='card-mountain' data-size='${sizes.mountain}' data-initial='${p.mountain}'>${p.mountain}</div>
          <div class='card-ocean' data-size='${sizes.ocean}' data-initial='${p.ocean}'>${p.ocean}</div>

          <div class='card-text'>
            <div class='card-qrcode-container'>
              <a href="https://www.equinox-ccg.io/fr-fr/cards/${p.uid}" target="_blank" class='card-qrcode'></a>
            </div>
          </div>
        </div>

        <div class='altered-card-statuses'></div>
      </div>`;
    },
    tplTokenCardTooltip(card) {
      return `<div id="card-${card.id}-tooltip" class='altered-card-tooltip'>
        ${this.tplTokenCard(card, true, false)}
        <div class='tooltip-explanation'>${this.getCardTooltipExplanation(card)}</div>
      </div>`;
    },

    tplSpellCard(card, tooltip = false, mini = false) {
      let p = card.properties;
      let frameSize = tooltip ? $(`card-${card.id}`).querySelector('.card-frame').dataset.size : 1;
      let textFontSize = tooltip ? $(`card-${card.id}`).querySelector('.card-text').style.fontSize : FONT_SIZE;
      let changed = (name) => (p.changedStats && p.changedStats.includes(name) ? ' altered' : '');
      return `<div id="card-${card.id}${tooltip ? 'tooltip' : ''}" data-id="${card.id}" 
        class='altered-card card-spell ${mini ? 'mini-card' : ''}'>
        <div class='altered-card-wrapper' data-asset='${p.asset}'>
          <div class='card-frame' data-size='${frameSize}' data-faction='${p.faction}' 
              data-rarity='${p.rarity}' data-support='${p.supportDesc ? 1 : 0}' data-type='spell'></div>
          <div class='rarity-gem' data-rarity='${p.rarity}'></div>
          <div class='card-hand-cost ${changed('costHand')}'>${p.costHand}</div>
          <div class='card-reserve-cost ${changed('costReserve')}'>${p.costReserve}</div>
          <div class='card-costs-bg' data-faction='${p.faction}'></div>

          <div class='card-name'>${_(p.name)}</div>
          <div class='card-typeline'>${_(p.typeline)}</div>

          <div class='card-text' style="font-size:${textFontSize}">
            <div class='card-qrcode-container'>
              <a href="https://www.equinox-ccg.io/fr-fr/cards/${p.uid}" target="_blank" class='card-qrcode'></a>
            </div>
            <div class='card-effect'>
              ${this.formatString(_(p.effectDesc) || '')}
            </div>
            <div class='card-reminders'>
            ${p.reminders ? this.formatString(_(p.reminders)) : ''}
            </div>
          </div>
        </div>

        <div class='altered-card-statuses'></div>
      </div>`;
    },
    tplSpellCardTooltip(card) {
      let p = card.properties;
      return `<div id="card-${card.id}-tooltip" class='altered-card-tooltip'>
        ${this.tplSpellCard(card, true, false)}
        <div class='tooltip-explanation'>${this.getCardTooltipExplanation(card)}</div>
      </div>`;
    },

    tplPermanentCard(card, tooltip = false, mini = false) {
      let p = card.properties;
      let frameSize = tooltip ? $(`card-${card.id}`).querySelector('.card-frame').dataset.size : 1;
      let textFontSize = tooltip ? $(`card-${card.id}`).querySelector('.card-text').style.fontSize : FONT_SIZE;
      let changed = (name) => (p.changedStats && p.changedStats.includes(name) ? ' altered' : '');
      return `<div id="card-${card.id}${tooltip ? 'tooltip' : ''}" data-id="${card.id}" 
        class='altered-card card-permanent ${mini ? 'mini-card' : ''}'>
        <div class='altered-card-wrapper' data-asset='${p.asset}'>
          <div class='card-frame' data-size='${frameSize}' data-faction='${p.faction}' 
              data-rarity='${p.rarity}' data-support='${p.supportDesc ? 1 : 0}' data-type='permanent'></div>
          <div class='rarity-gem' data-rarity='${p.rarity}'></div>
          <div class='card-hand-cost ${changed('costHand')}'>${p.costHand}</div>
          <div class='card-reserve-cost ${changed('costReserve')}'>${p.costReserve}</div>
          <div class='card-costs-bg' data-faction='${p.faction}'></div>

          <div class='card-name'>${_(p.name)}</div>
          <div class='card-typeline'>${_(p.typeline)}</div>

          <div class='card-text' style="font-size:${textFontSize}">
            <div class='card-qrcode-container'>
              <a href="https://www.equinox-ccg.io/fr-fr/cards/${p.uid}" target="_blank" class='card-qrcode'></a>
            </div>
            <div class='card-effect'>
              ${this.formatString(_(p.effectDesc) || '')}
            </div>
            <div class='card-reminders'>
            ${p.reminders ? this.formatString(_(p.reminders)) : ''}
            </div>
          </div>
        </div>

        <div class='altered-card-statuses'></div>
      </div>`;
    },

    tplPermanentCardTooltip(card) {
      let p = card.properties;
      return `<div id="card-${card.id}-tooltip" class='altered-card-tooltip'>
        ${this.tplPermanentCard(card, true, false)}
        <div class='tooltip-explanation'>${this.getCardTooltipExplanation(card)}</div>
      </div>`;
    },

    autofitCardFrame(oCard) {
      if (!oCard.querySelector('.card-effect')) return;
      let isMini = oCard.classList.contains('mini-card');
      if (isMini) oCard.classList.remove('mini-card');

      // Fit effect + reminders
      let isEffectSizeOk = () =>
        oCard.querySelector('.card-text').offsetHeight >=
        oCard.querySelector('.card-effect').offsetHeight + oCard.querySelector('.card-reminders').offsetHeight;
      if (!isEffectSizeOk()) {
        oCard.querySelector('.card-frame').dataset.size = 2;
        oCard.offsetHeight;
        for (let i = 13; i >= 10 && !isEffectSizeOk(); i--) {
          oCard.querySelector('.card-text').style.fontSize = `${i}px`;
        }
      }

      // Add back mini if needed
      if (isMini) oCard.classList.add('mini-card');
    },

    getMeeplesOnCard(cardId) {
      if (!$(`card-${cardId}`)) return [];
      return [...$(`card-${cardId}`).querySelectorAll('.altered-meeple:not(.phantom)')];
    },

    updateStatusIfCard(elt) {
      if ($(elt).classList.contains('altered-card')) this.updateCardStatuses($(elt).dataset.id);
    },

    updateCardStatuses(cardId) {
      let container = $(`card-${cardId}`).querySelector('.altered-card-statuses');
      if (!container) return;
      container.innerHTML = '';

      const ICONS = ['fleeting', 'anchored', 'sleeping', 'boost'];
      let boost = 0;
      this.getMeeplesOnCard(cardId).forEach((meeple) => {
        let type = meeple.dataset.type;
        if (!ICONS.includes(type)) return;

        if (type == 'boost') {
          boost++;
          return;
        }

        container.insertAdjacentHTML('beforeend', `<div class='card-status'>${this.formatSvgIcon(type)}</div>`);
      });

      if ($(`card-${cardId}`).querySelector('.card-forest') != null) {
        let p = {
          forest: parseInt($(`card-${cardId}`).querySelector('.card-forest').getAttribute('data-initial')) + boost,
          mountain: parseInt($(`card-${cardId}`).querySelector('.card-mountain').getAttribute('data-initial')) + boost,
          ocean: parseInt($(`card-${cardId}`).querySelector('.card-ocean').getAttribute('data-initial')) + boost,
        };
        let sizes = this.getBiomesUISizes(p);
        $(`card-${cardId}`).querySelector('.card-forest').setAttribute('data-size', sizes.forest);
        $(`card-${cardId}`).querySelector('.card-forest').innerHTML = p.forest;
        $(`card-${cardId}`).querySelector('.card-mountain').setAttribute('data-size', sizes.mountain);
        $(`card-${cardId}`).querySelector('.card-mountain').innerHTML = p.mountain;
        $(`card-${cardId}`).querySelector('.card-ocean').setAttribute('data-size', sizes.ocean);
        $(`card-${cardId}`).querySelector('.card-ocean').innerHTML = p.ocean;
      }
    },

    getCardTooltipExplanation(card) {
      let explanation = '';
      this.getMeeplesOnCard(card.id).forEach((oMeeple) => {
        let tooltipDesc = this.getMeepleTooltip({ type: oMeeple.dataset.type });
        if (tooltipDesc != null) {
          explanation += tooltipDesc.map((t) => this.formatString(t)).join('<br/>');
        }
      });

      return explanation;
    },

    // getAbilityDesc(ability, n, card) {
    //   let descs = {};

    //   let desc = descs[ability];
    //   let result = {
    //     title: desc[0],
    //     desc: n == 1 && desc.length > 2 ? desc[2] : desc[1],
    //   };

    //   if (n !== null) {
    //     result.title = this.fsr(result.title, { i18n: ['n'], n });
    //     result.desc = this.fsr(result.desc, { i18n: ['n'], n, icon: this.formatIcon(`action-card-${n}`) });
    //   } else {
    //     result.desc = this.formatString(result.desc);
    //   }
    //   return result;
    // },
  });
});
