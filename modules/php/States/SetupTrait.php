<?php

namespace ALT\States;

use ALT\Core\Globals;
use ALT\Core\Notifications;
use ALT\Core\Engine;
use ALT\Core\Stats;
use ALT\Core\Preferences;
use ALT\Managers\Players;
use ALT\Managers\Cards;
use ALT\Managers\Meeples;
use ALT\Helpers\Log;

trait SetupTrait
{
  /*
   * setupNewGame:
   */
  protected function setupNewGame($players, $options = [])
  {
    Globals::setupNewGame($players, $options);
    Players::setupNewGame($players, $options);
    // Preferences::setupNewGame($players, $this->player_preferences);

    Globals::setFirstPlayer($this->getNextPlayerTable()[0]);
    Players::initializeDecks();
    Stats::checkExistence();

    $this->setGameStateInitialValue('logging', false);
    $this->gamestate->setAllPlayersMultiactive();
    $this->activeNextPlayer();
  }

  //////////////////////////////////
  //// API
  ///////////////////////

  function equinoxAPIConnect($params)
  {
    $mode = $params['mode'];
    $user = $params['user'] ?? '';
    $secret = $params['secret'] ?? '';
    $token = $params['token'] ?? '';
    $deckId = $params['deckId'] ?? '';
    $cardId = $params['cardId'] ?? '';
    $curl = curl_init();
    // $baseUrl = 'https://api.equinox-ccg.io';
    $baseUrl = 'https://api.altered.gg';
    $setup = [
      CURLOPT_URL => $baseUrl . '/login',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    ];

    switch ($mode) {
      case 'login':
        $setup[CURLOPT_URL] = $baseUrl . '/login';
        $setup[CURLOPT_POSTFIELDS] =
          '{
              "email": "' .
          $user .
          '",
              "password": "' .
          $secret .
          '"
          }';
        $setup[CURLOPT_HTTPHEADER] = ['Content-Type: application/json'];
        $setup[CURLOPT_CUSTOMREQUEST] = 'POST';
        break;
      case 'BGALogin':
        $setup[CURLOPT_URL] = $baseUrl . '/login';
        $setup[CURLOPT_POSTFIELDS] =
          '{
                "email": "' .
          'bga@equinox.fr' .
          '",
                "password": "' .
          'Q39jXhb7E6HnZEbc' .
          '"
            }';
        $setup[CURLOPT_HTTPHEADER] = ['Content-Type: application/json'];
        $setup[CURLOPT_CUSTOMREQUEST] = 'POST';
        break;
      case 'deckList':
        // token of the player
        $setup[CURLOPT_URL] = $baseUrl . '/deck_user_lists/?isLegal=true';
        $setup[CURLOPT_HTTPHEADER] = ['token: ' . $token, 'Authorization: Bearer ' . $token];
        $setup[CURLOPT_CUSTOMREQUEST] = 'GET';
        // throw new \feException(print_r($setup));
        break;
      case 'deck':
        // token of the player
        $setup[CURLOPT_URL] = $baseUrl . $deckId;
        $setup[CURLOPT_HTTPHEADER] = ['token: ' . $token, 'Authorization: Bearer ' . $token];
        $setup[CURLOPT_CUSTOMREQUEST] = 'GET';
        break;
      case 'card':
        // BGA token
        $setup[CURLOPT_URL] = $baseUrl . '/cards/' . $cardId;
        $setup[CURLOPT_HTTPHEADER] = ['token: ' . $token, 'Authorization: Bearer ' . $token];
        $setup[CURLOPT_CUSTOMREQUEST] = 'GET';
        break;
    }
    curl_setopt_array($curl, $setup);
    $response = json_decode(curl_exec($curl), true);
    curl_close($curl);
    return $response;
  }

  function connectToAPI($user, $secret)
  {
    // return 12345;
    // TODO: uncomment later on
    // $response = $this->equinoxAPIConnect(['mode' => 'login', 'user' => $user, 'secret' => $secret]);
    $response = self::masterNodeRequest('getGameSpecificMetaInfos', [
      'game' => 'alter' . 'ed',
      'mode' => 'login',
      'user' => $user,
      'secret' => $secret,
    ]);
    if (!isset($response['token'])) {
      throw new \feException('Invalid login or password');
    }
    $token = $response['token'];
    return $token;
  }

  function updateAPIDeckList($pId, $token)
  {
    // $decks = $this->equinoxAPIConnect(['mode' => 'deckList', 'token' => $token]);
    $decks = self::masterNodeRequest('getGameSpecificMetaInfos', [
      'game' => 'alter' . 'ed',
      'mode' => 'deckList',
      'token' => $token,
    ]);

    // TODO: to comment when API
    // require_once dirname(__FILE__) . '/../Cards/apiInfos.php';

    // END TODO

    $deckList = [];
    $numDeck = 0;
    foreach ($decks['hydra:member'] as $deck) {
      $deckList[$numDeck] = [
        'deckNum' => $numDeck,
        'apiId' => $deck['@id'],
        'faction' => $deck['faction']['name'],
        'deckName' => $deck['name'],
        'hero' => $deck['alterator']['@id'],
        'cardCount' => $deck['cardQuantity'],
      ];
      $numDeck++;
    }

    return $deckList;
  }

  function getAPIDeckContent($token, $deckId)
  {
    // $deck = $this->equinoxAPIConnect(['mode' => 'deck', 'token' => $token, 'deckId' => $deckId]);
    // $BGAToken = $this->equinoxAPIConnect(['mode' => 'BGALogin'])['token'];

    $deck = self::masterNodeRequest('getGameSpecificMetaInfos', [
      'game' => 'alter' . 'ed',
      'mode' => 'deck',
      'token' => $token,
      'deckId' => $deckId,
    ]);
    $BGAToken = self::masterNodeRequest('getGameSpecificMetaInfos', [
      'game' => 'alter' . 'ed',
      'mode' => 'BGALogin',
    ])['token'];

    // TODO: remove when API
    // require_once dirname(__FILE__) . '/../Cards/apiInfos.php';
    // $deck = $deckInfos;
    // END TODO
    $deckContent = [];
    $deckContent[HERO] = ['card' => Cards::getCardClass($deck['alterator']['reference']), 'n' => 1];
    foreach (['character', 'spell', 'permanent'] as $type) {
      foreach ($deck['deckCardsByType'][$type]['deckUserListCard'] ?? [] as $c) {
        if ($c['card']['rarity']['reference'] == 'UNIQUE') {
          // $uniqueCard = $this->equinoxAPIConnect(['mode' => 'card', 'token' => $BGAToken, 'cardId' => $c['card']['reference']]);
          $uniqueCard = self::masterNodeRequest('getGameSpecificMetaInfos', [
            'game' => 'alter' . 'ed', 'mode' => 'card', 'token' => $BGAToken, 'cardId' => $c['card']['reference']
          ]);

          if (is_null(Cards::generateUnique($uniqueCard))) {
            continue; // TODO: remove
            throw new \BgaVisibleSystemException(
              clienttranslate('This unique has an unimplemented power' . $c['card']['reference'])
            );
          }
          $deckContent[] = ['card' => ['properties' => Cards::generateUnique($uniqueCard)], 'n' => $c['quantity']];
        } else {
          $deckContent[] = ['card' => Cards::getCardClass($c['card']['reference']), 'n' => $c['quantity']];
        }
      }
    }

    $gContent = Globals::getDeckContent();
    $gContent[Players::getCurrentId()] = $deckContent;
    Globals::setDeckContent($gContent);

    return $deckContent;
  }

  //////////////////////////////////////////////////////////////////
  //  ____
  // |  _ \ _ __ ___  ___ ___  ___
  // | |_) | '__/ _ \/ __/ _ \/ __|
  // |  __/| | |  __/ (_| (_) \__ \
  // |_|   |_|  \___|\___\___/|___/
  //////////////////////////////////////////////////////////////////

  function getDeckHero($deckNumber)
  {
    return Cards::getInLocation("deck-$deckNumber")
      ->where('type', HERO)
      ->first();
  }

  function argsPrecoDeckSelection()
  {
    $args = [
      '_private' => [],
    ];
    $allDecks = Globals::getPlayerDecks();
    $selection = Globals::getDeckSelection();
    foreach (Players::getAll() as $pId => $player) {
      $decks = $allDecks[$pId] ?? [];
      foreach ($decks as &$deck) {
        $deck['hero'] = $this->getDeckHero($deck['deckNum']);
      }
      $args['_private'][$pId]['decks'] = $decks;
      $args['_private'][$pId]['selection'] = $selection[$pId] ?? null;
    }

    return $args;
  }

  public function actLoaAPIdDecks($login, $secret)
  {
    $token = $this->connectToAPI($login, $secret);
    $deckList = $this->updateAPIDeckList(Players::getCurrent()->getId(), $token);
    // getdecks and create in DB
    // Notifications::updateDeckList(Players::getCurrent(), $deckList);
    return $deckList;
  }

  public function actGetDeckInfos($login, $secret, $deckID)
  {
    $token = $this->connectToAPI($login, $secret);
    return $this->getAPIDeckContent($token, $deckID);
  }

  public function actConfirmAPIDeck()
  {
    $this->gamestate->checkPossibleAction('actConfirmAPIDeck');

    $player = Players::getCurrent();
    $selection = Globals::getDeckSelection();
    $selection[$player->getId()] = 'API';
    Globals::setDeckSelection($selection);
    Notifications::updateInitialPrecoDeckSelection($player, self::argsPrecoDeckSelection());

    $this->updateActivePlayersPrecoDeckSelection();
  }

  public function actSelectPrecoDeck($choice)
  {
    $this->gamestate->checkPossibleAction('actSelectPrecoDeck');

    $player = Players::getCurrent();
    $selection = Globals::getDeckSelection();
    $selection[$player->getId()] = $choice;
    Globals::setDeckSelection($selection);
    Notifications::updateInitialPrecoDeckSelection($player, self::argsPrecoDeckSelection());

    $this->updateActivePlayersPrecoDeckSelection();
  }

  public function actCancelPrecoDeckSelection()
  {
    $this->gamestate->checkPossibleAction('actCancelPrecoDeckSelection');

    $player = Players::getCurrent();
    $selection = Globals::getDeckSelection();
    unset($selection[$player->getId()]);
    Globals::setDeckSelection($selection);
    Notifications::updateInitialPrecoDeckSelection($player, self::argsPrecoDeckSelection());

    $this->updateActivePlayersPrecoDeckSelection();
  }

  public function updateActivePlayersPrecoDeckSelection()
  {
    // Compute players that still need to select their card
    // => use that instead of BGA framework feature because in some rare case a player
    //    might become inactive eventhough the selection failed (seen in Agricola and Rauha at least already)
    $selection = Globals::getDeckSelection();
    $players = Players::getAll();
    $ids = $players->getIds();
    $ids = array_diff($ids, array_keys($selection));

    // At least one player need to make a choice
    if (!empty($ids)) {
      $this->gamestate->setPlayersMultiactive($ids, 'done', true);
    }
    // Everyone is done => discard cards and proceed
    else {
      $this->gamestate->nextState('done');
    }
  }

  //////////////////////////////////////////////////////////////////
  //    ____ _                                _           _
  //   / ___| |__   ___   ___  ___  ___    __| | ___  ___| | __
  //  | |   | '_ \ / _ \ / _ \/ __|/ _ \  / _` |/ _ \/ __| |/ /
  //  | |___| | | | (_) | (_) \__ \  __/ | (_| |  __/ (__|   <
  //   \____|_| |_|\___/ \___/|___/\___|  \__,_|\___|\___|_|\_\
  //////////////////////////////////////////////////////////////////

  // function argsDeckSelection()
  // {
  //   $args = [
  //     '_private' => [],
  //   ];
  //   $allDecks = Globals::getPlayerDecks();
  //   $selection = Globals::getDeckSelection();
  //   foreach (Players::getAll() as $pId => $player) {
  //     $decks = $allDecks[$pId];
  //     foreach ($decks as &$deck) {
  //       $deck['hero'] = $this->getDeckHero($deck['deckNum']);
  //     }
  //     $args['_private'][$pId]['decks'] = $decks;
  //     $args['_private'][$pId]['selection'] = $selection[$pId] ?? null;
  //   }

  //   return $args;
  // }

  // public function actSelectDeck($choice)
  // {
  //   $this->gamestate->checkPossibleAction('actSelectDeck');

  //   $player = Players::getCurrent();
  //   $selection = Globals::getDeckSelection();
  //   $selection[$player->getId()] = $choice;
  //   Globals::setDeckSelection($selection);
  //   Notifications::updateInitialDeckSelection($player, self::argsDeckSelection());

  //   $this->updateActivePlayersDeckSelection();
  // }

  // public function actCancelDeckSelection()
  // {
  //   $this->gamestate->checkPossibleAction('actCancelDeckSelection');

  //   $player = Players::getCurrent();
  //   $selection = Globals::getDeckSelection();
  //   unset($selection[$player->getId()]);
  //   Globals::setDeckSelection($selection);
  //   Notifications::updateInitialDeckSelection($player, self::argsDeckSelection());

  //   $this->updateActivePlayersDeckSelection();
  // }

  // function actGetDeck($deckNumber)
  // {
  //   self::checkAction('actGetDeck');
  //   $player = Players::getCurrent();
  //   if (!in_array($deckNumber, array_keys(Globals::getPlayerDecks()[$player->getId()]))) {
  //     throw new \BgaVisibleSystemException('You do not have a deck with this number. Should not happen');
  //   }
  //   return $player->getDeck($deckNumber)->toArray();
  // }

  /////////////////////////////////////////////////////////
  //  ____       _                     _           _
  // / ___|  ___| |_ _   _ _ __     __| | ___  ___| | __
  // \___ \ / _ \ __| | | | '_ \   / _` |/ _ \/ __| |/ /
  //  ___) |  __/ |_| |_| | |_) | | (_| |  __/ (__|   <
  // |____/ \___|\__|\__,_| .__/   \__,_|\___|\___|_|\_\
  //                      |_|
  /////////////////////////////////////////////////////////

  function stDeckSetup()
  {
    $selection = Globals::getDeckSelection();
    // throw new \feException(print_r(Globals::getDeckContent()));
    $factionMap = [FACTION_AX => 1, FACTION_BR => 2, FACTION_LY => 3, FACTION_MU => 4, FACTION_OD => 5, FACTION_YZ => 6];
    $factions = [];
    foreach (Players::getAll() as $pId => $player) {
      if ($selection[$pId] == 'API') {
        $deckContent = Globals::getDeckContent()[$pId];
        $faction = Cards::createDeck($player, $deckContent);
      } elseif ($selection[$pId] == 'random') {
        $faction = Cards::generateRandomDeck($player);
        $selection[$pId] = 'API';
      } else {
        $deckNumber = $selection[$pId];
        // faction setup
        $faction = Globals::getPlayerDecks()[$pId][$deckNumber]['faction'];
      }
      $player->setFaction($faction);
      $factions[$pId] = $faction;
      Stats::setFaction($player, $factionMap[$faction]);
    }
    Notifications::vsScreen($factions);

    foreach (Players::getAll() as $pId => $player) {
      $deckNumber = $selection[$pId];

      // delete all other cards
      $toDel = Cards::getFiltered($pId)->whereNot('location', "deck-$deckNumber");
      Cards::delete($toDel->getIds());

      // updating Cards
      $hero = $this->getDeckHero($deckNumber);
      $hero->setLocation("board-hero-$pId");
      Cards::getFiltered($pId)
        ->where('location', "deck-$deckNumber")
        ->update('location', "deck-$pId");

      $meeples = Meeples::setupPlayer($player);

      // shuffling of dec
      Cards::shuffle("deck-$pId");
      Notifications::setupDeck($player, $meeples, $hero);
    }

    // TODO : remove ???
    //    Notifications::setupCards(Cards::getUiData());

    $this->gamestate->nextState('');
  }
}
