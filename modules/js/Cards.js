define(['dojo', 'dojo/_base/declare', g_gamethemeurl + 'modules/js/cardsData.js'], (dojo, declare) => {
  function isVisible(elem) {
    return !!(elem.offsetWidth || elem.offsetHeight || elem.getClientRects().length);
  }

  const isObject = (obj) => {
    return typeof obj === 'object' && obj !== null && !Array.isArray(obj);
  };

  const ALTERATEUR = 'alterateur';
  const EXPLORER = 'explorer';
  const PERMANENT = 'permanent';
  const SPELL = 'spell';

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

      // this.loadSaveCard(card);
      if (container === null) {
        container = this.getCardContainer(card);
      }

      let o = this.place('tplCard', card, container);
      if (o !== undefined) {
        this.addCustomTooltip(o.id, () => this.tplCardTooltip(card), { midSize: false });
      }
    },

    getCardContainer(card) {
      let t = card.location.split('_');
      let type = card.properties.type;
      if (type == ALTERATEUR) {
        return $(card.location);
      }
      // if (card.location == 'hand') {
      //   return $(`hand-${card.pId}`);
      // }

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
    notif_pDiscardMana(n) {
      debug('Notif: private discarding to mana', n);
      // TODO
    },

    /**
     * Public notification when discarding cards:
     *  ignore if current player is the one discarding card
     *  slide fakes cards from player panel to titlebar and decrease hand count
     */
    notif_discardMana(n) {
      debug('Notif: public mana cards', n);
      // TODO
    },

    /**
     * Private notification for the player drawing the card :
     */
    notif_pDrawCards(n) {
      debug('Notif: private drawing cards', n);
      // TODO
    },

    /**
     * Public notification when drawing cards:
     *  ignore if current player is the one drawing card
     */
    notif_drawCards(n) {
      debug('Notif: public mana cards', n);
      // TODO
    },

    notif_discard(n) {
      debug('Notif: public discarding cards', n);
      // TODO (echo effect, etc.)
    },

    notif_tap(n) {
      debug('Notif: tapping card', n);
      // TODO (tap card, etc.)
    },

    notif_boost(n) {
      debug('Notif: boosting card', n);
      // TODO slide tokens + update counters
    },

    notif_untap(n) {
      debug('Notif: untapping card(s', n);
      // TODO
      // It can contain multiple cards!
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

    tplCard(card) {
      let type = card.properties.type;
      if (type == ALTERATEUR) {
        return this.tplAlterateurCard(card);
      } else if (type == EXPLORER) {
        return this.tplExplorerCard(card);
      } else if (type == SPELL) {
        return this.tplSpellCard(card);
      } else if (type == PERMANENT) {
        return this.tplPermanentCard(card);
      }

      console.error('No tpl yet', card);
      return '';
    },

    tplCardTooltip(card) {
      let type = card.properties.type;
      // if (type == ALTERATEUR) {
      //   return this.tplAlterateurCard(card);
      // } else
      if (type == EXPLORER) {
        return this.tplExplorerCardTooltip(card);
      } else if (type == SPELL) {
        return this.tplSpellCardTooltip(card);
      }
      //else if (type == PERMANENT) {
      //   return this.tplPermanentCard(card);
      // }

      return '';
    },

    tplAlterateurCard(card) {
      return `<div id="${card.id}" class='altered-card card-alterateur'>
        <div class='altered-card-wrapper' data-asset='${card.properties.asset}'>
        </div>
      </div>`;
    },

    getBiomesUISizes(card) {
      let p = card.properties;
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

    tplExplorerCard(card) {
      let p = card.properties;
      let sizes = this.getBiomesUISizes(card);
      return `<div id="${card.id}" class='altered-card card-explorer'>
        <div class='altered-card-wrapper' data-asset='${p.asset}'>
          <div class='card-hand-cost'>${p.costHand}</div>
          <div class='card-memory-cost' data-faction='${p.faction}'>${p.costMemory}</div>
          <div class='card-forest' data-size='${sizes.forest}'>${p.forest}</div>
          <div class='card-mountain' data-size='${sizes.mountain}'>${p.mountain}</div>
          <div class='card-ocean' data-size='${sizes.ocean}'>${p.ocean}</div>
        </div>
      </div>`;
    },
    tplExplorerCardTooltip(card) {
      let p = card.properties;
      let sizes = this.getBiomesUISizes(card);
      return `<div id="${card.id}-tooltip" class='altered-card-tooltip'>
        <div class='altered-card card-explorer'>
          <div class='altered-card-wrapper' data-asset='${p.asset}'>
            <div class='card-frame' data-frame='${p.frameSize}' data-faction='${p.faction}' 
                data-rarity='${p.rarity}' data-type='explorer'></div>
            <div class='card-hand-cost'>${p.costHand}</div>
            <div class='card-memory-cost'>${p.costMemory}</div>
            <div class='card-name'>${_(p.name)}</div>
            <div class='card-types'>${_(p.type)}</div>

            <div class='card-forest' data-size='${sizes.forest}'>${p.forest}</div>
            <div class='card-mountain' data-size='${sizes.mountain}'>${p.mountain}</div>
            <div class='card-ocean' data-size='${sizes.ocean}'>${p.ocean}</div>
          </div>
        </div>
        <div class='tooltip-explanatin'>
          More details here
        </div>
      </div>`;
    },

    tplSpellCard(card) {
      let p = card.properties;
      return `<div id="${card.id}" class='altered-card card-spell'>
        <div class='altered-card-wrapper' data-asset='${p.asset}'>
          <div class='card-hand-cost'>${p.costHand}</div>
          <div class='card-memory-cost' data-faction='${p.faction}'>${p.costMemory}</div>
        </div>
      </div>`;
    },
    tplSpellCardTooltip(card) {
      let p = card.properties;
      return `<div id="${card.id}-tooltip" class='altered-card-tooltip'>
        <div class='altered-card card-spell'>
          <div class='altered-card-wrapper' data-asset='${p.asset}'>
            <div class='card-frame' data-frame='${p.frameSize}' data-faction='${p.faction}' 
                data-rarity='${p.rarity}' data-type='spell'></div>
            <div class='card-hand-cost'>${p.costHand}</div>
            <div class='card-memory-cost'>${p.costMemory}</div>
            <div class='card-name'>${_(p.name)}</div>
            <div class='card-types'>${_(p.type)}</div>
          </div>
        </div>
        <div class='tooltip-explanatin'>
          More details here
        </div>
      </div>`;
    },

    tplPermanentCard(card) {
      return `<div id="${card.id}" class='altered-card card-permanent'>
        <div class='altered-card-wrapper' data-asset='${card.properties.asset}'>
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
