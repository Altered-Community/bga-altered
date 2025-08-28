<?php

namespace ALT\Managers;

use ALT\Core\Globals;
use ALT\Core\Game;
use ALT\Core\Notifications;
use ALT\Helpers\FlowConvertor;
use ALT\Helpers\Utils;
use ALT\Helpers\Log;
use ALT\Managers\Players;
use ALT\Models\Card;

/* Class to manage all the cards for Altered */

function slugify($text)
{
  $text = str_replace('ō', 'o', $text);
  $text = str_replace('ö', 'o', $text);
  $text = str_replace('ā', 'a', $text);
  $text = preg_replace('~[^\pL\d]+~u', '', $text);
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
  $text = preg_replace('~[^-\w]+~', '', $text);
  $text = trim($text, '');
  if (empty($text)) {
    return 'n-a';
  }
  return $text;
}

class Cards extends \ALT\Helpers\CachedPieces
{
  use \ALT\States\SetupTrait; // temp for API

  protected static $table = 'cards';
  protected static $prefix = 'card_';
  protected static $customFields = ['player_id', 'properties'];
  protected static $autoIncrement = true;
  protected static $autoremovePrefix = false;
  protected static $autoreshuffle = true;
  protected static $autoreshuffleCustom = ['deck' => 'discard'];
  protected static $autoreshuffleListener = ['obj' => 'ALT\Managers\Cards', 'method' => 'shuffleDeck'];
  protected static $datas = null;

  protected static function cast($card)
  {
    return self::getCardInstance($card['card_id'], $card);
  }

  public static function getCardInstance($id, $data = null)
  {
    $rarities = [
      RARITY_COMMON => 'Common',
      RARITY_RARE => 'Rare',
      RARITY_UNIQUE => 'Unique',
    ];
    $p = json_decode($data['properties'], true);
    $faction = $p['faction'];
    $rarity = $rarities[$p['rarity']] ?? 'Common';

    $slug = slugify($p['name']);
    $className = '\\ALT\\Cards\\' . $faction . '\\' . $faction . '_' . $rarity . '_' . $slug;

    $isUnique = $p['rarity'] == RARITY_UNIQUE;
    // Unique => all infos are stored into DB
    if ($isUnique) {
      return new Card($data); // information from DB
    }
    // Non-unique => take non-dynamic properties from files
    else {
      if (class_exists($className)) {
        $card = new $className($data); // no DB call

        $prop = json_decode($data['properties'], true);
        // Update dynamic properties
        foreach (DYNAMIC_PROPERTIES as $p) {
          $v = $prop[$p] ?? null;
          if (!is_null($v)) {
            $card->setProperty($p, $v, false);
          }
        }
        return $card;
      }
    }
  }

  public static function isKS($uid)
  {
    return explode('_', $uid)[1] == 'COREKS';
  }

  public static function isAlternateArt($uid)
  {
    return explode('_', $uid)[2] == 'A';
  }

  public static function getNextPlayedState()
  {
    $max = -1;
    $played = self::getFiltered(null, IN_PLAY);
    foreach ($played as $cId => $card) {
      $max = max($max, $card->getState());
    }
    return $max;
  }

  public static function getAltUid($uid)
  {
    $expUid = explode('_', $uid);
    $expUid[1] = 'COREKS';
    if (count($expUid) == 7) {
      unset($expUid[6]);
    }
    unset($expUid[5]);
    $altUid = implode('_', $expUid);
    return $altUid;
  }

  public static function getCoreUid($uid)
  {
    $expUid = explode('_', $uid);
    $expUid[1] = 'CORE';
    $coreUid = implode('_', $expUid);
    return $coreUid;
  }

  public static function getMainUid($uid)
  {
    $expUid = explode('_', $uid);
    $expUid[2] = 'B';
    $coreUid = implode('_', $expUid);
    return $coreUid;
  }

  public static function getAlternateUid($uid)
  {
    $expUid = explode('_', $uid);
    if (count($expUid) == 7) {
      unset($expUid[6]);
    }
    unset($expUid[5]);
    $altUid = implode('_', $expUid);
    return $altUid;
  }

  public static function getIconSet($uid)
  {
    $expUid = explode('_', $uid);
    switch ($expUid[1]) {
      case 'COREKS':
        return 'ks';
      case 'ALIZE':
        return 'tbf';
      case 'BISE':
        return 'wfm';
      default:
        return null;
    }
  }

  public static function getCardClass($uid)
  {
    require_once dirname(__FILE__) . '/../Cards/cards.inc.php';
    // Mapping done for heroes for example
    if (isset(UID_MAPPING[$uid])) {
      $uid = UID_MAPPING[$uid];
    }

    $ks = self::isKS($uid);
    $alternate = self::isAlternateArt($uid);
    if ($ks) {
      $coreUid = self::getCoreUid($uid);
      $altUid = self::getAltUid($uid);
    } elseif ($alternate) {
      $coreUid = self::getMainUid($uid);
      $altUid = self::getAlternateUid($uid);
    }

    if (!isset(MAP_REFS_CLASSES[$uid])) {
      if (!isset(MAP_REFS_CLASSES[$coreUid])) {
        throw new \BgaVisibleSystemException('This card is not implemented ' . $uid . ' ' . $coreUid . 't');
      } elseif ($ks || $alternate) {
        $uid = $coreUid;
      }
    }

    $cInfo = explode('/', MAP_REFS_CLASSES[$uid]);
    $className = "\\ALT\\Cards\\$cInfo[0]\\$cInfo[1]";
    $iconSet = self::getIconSet($uid);
    $row = null;

    $cardO = new $className($row);
    if (!is_null($iconSet)) {
      $cardO->setSetIcon($iconSet);
    }

    if ($ks || $alternate) {
      if (isset(self::getAltArt()[$altUid])) {
        $cardO->setFlavorText(self::getAltArt()[$altUid]['flavorText']);
        if ($cardO->getRarity() == RARITY_RARE) {
          $cardO->setAsset($altUid . '_R');
        } elseif ($cardO->getRarity() == RARITY_COMMON) {
          $cardO->setAsset($altUid . '_C');
        } else {
          $cardO->setAsset($altUid . '_U');
        }
      }
    }
    return $cardO;
    // return new $className($row);
  }

  public static function generateRandomDeck($deck, $player)
  {
    // For production
    // $deckContent[HERO] = ['card' => Cards::getCardClass($deck[HERO])->jsonSerialize(), 'n' => 1];
    // foreach ($deck['cards'] as $cardRef => $card) {
    //   if (isset($card['content'])) {
    //     //it's a unique!
    //     if (is_null(Cards::generateUnique($card['content']))) {
    //       throw new \BgaVisibleSystemException(
    //         'This unique has an unimplemented power' . $card['content']['reference']
    //       );
    //     }
    //     $deckContent[] = ['card' => ['properties' => Cards::generateUnique($card['content'])], 'n' => 1];
    //   } else {
    //     $deckContent[] = ['card' => Cards::getCardClass($cardRef)->jsonSerialize(), 'n' => $card['quantity']];
    //   }
    // }

    // return self::createDeck($player, $deckContent);

    require_once dirname(__FILE__) . '/../Cards/cards.inc.php';
    require_once dirname(__FILE__) . '/../Cards/uniques.list.inc.php';


    // // $BGAToken = Game::get()->equinoxAPIConnect(['mode' => 'BGALogin'])['token'];
    // // $BGAToken = Game::get()->masterNodeRequest('getGameSpecificMetaInfos', [
    // //   'game' => 'alter' . 'ed',
    // //   'mode' => 'BGALogin',
    // // ])['token'];

    // $result = Game::get()->getGenericGameInfos('get_player_deck_content', ['deck_id' => '#BGA_RANDOM_42']);

    $faction = FACTIONS[array_rand(FACTIONS)];
    $deckContent = [];

    $deckContent[HERO] = [
      'card' => Cards::getCardClass(HEROES[$faction][array_rand(HEROES[$faction])])->jsonSerialize(),
      'n' => 1,
    ];
    // random cards of the faction
    $i = 0;
    $totalCards = 40;
    $repartition = ['' => 10, 'TBF' => 10, 'WFTM' => 20];
    $allocation = ['' => 0, 'TBF' => 0, 'WFTM' => 0];

    do {
      $c = array_rand(MAP_REFS_CLASSES);

      // $c = MAP_REFS_CLASSES[$a];
      // var_dump($c);
      $objCard = self::getCardClass($c);
      if ($objCard->getFaction() == $faction && $objCard->getType() != HERO) {
        if ($allocation[$objCard->getExtension()] < $repartition[$objCard->getExtension()]) {
          $deckContent[] = ['card' => $objCard->jsonSerialize(), 'n' => 1];
          $allocation[$objCard->getExtension()]++;
          $i++;
        }
      }
    } while ($i < $totalCards);

    for ($u = 0; $u < 15; $u++) {
      // maybe to reenable later  
      // $uniqueCard = Game::get()->equinoxAPIConnect(['mode' => 'card', 'token' => $BGAToken, 'cardId' => $cardId]);
      // $uniqueCard = Game::get()->masterNodeRequest('getGameSpecificMetaInfos', [
      //   'game' => 'alter' . 'ed',
      //   'mode' => 'card',
      //   'token' => $BGAToken,
      //   'cardId' => $cardId
      // ]);
      // throw new \feException(print_r($uniqueCard));
      $effects = [];
      for ($b = 0; $b < 2; $b++) {
        $cardId = CEG[array_rand(CEG)];
        $ceg = explode('_', $cardId);
        $found = false;
        foreach ($ceg as $c) {
          if (in_array($c, testedCEGS)) {
            $found = true;
          }
          if (in_array($c, [519, 520, 521, 522])) { // Man in the Maze exclusion
            $found = false;
            break;
          }
        }
        if (!$found) {
          $b--;
          continue;
        }
        $effects[] = [
          $ceg[0],
          $ceg[1],
          $ceg[2]
        ];
      }

      $uniqueCard = [
        'reference' => 'ALT_ALIZE_B_MU_33_U',
        'faction' => 'MU',
        'name' => 'Fake unique for testing',
        'cardType' => 'CHARACTER',
        'illustrator' => 'TOTO',
        'costHand' => 2,
        'costReserve' => 2,
        'forest' => 2,
        'mountain' => 2,
        'ocean' => 2,
        'uniqueReduced' => [
          [
            'effects' => $effects
          ]
        ]
      ];
      $properties = self::generateUnique($uniqueCard);
      if (is_null($properties)) {
        $u--;
        continue;
      }
      $deckContent[] = [
        'card' => ['properties' => $properties],
        'n' => 1,
      ];
      $i++;
    }

    return self::createDeck($player, $deckContent);
  }

  public static function generateUnique($unique)
  {
    // throw new \feException(print_r($unique));
    $properties = [];
    $properties['uid'] = $unique['reference'];
    $uid = $properties['uid'];
    $properties['rarity'] = RARITY_UNIQUE;

    $asset = explode('_', $unique['reference']);
    unset($asset[count($asset) - 1]);
    $properties['asset'] = implode('_', $asset);
    if (self::isKS($uid)) {
      $properties['setIcon'] = 'ks';

      $altUid = self::getAltUid($uid);
      // ALT_COREKS_B_YZ_04_4451
      if (isset(self::getAltArt()[$altUid])) {
        $properties['flavorText'] = self::getAltArt()[$altUid]['flavorText'];
        $properties['asset']  = $altUid . '_U';
      } else {
        $properties['asset']  = self::getCoreUid($altUid) . '_U';
      }
    }
    $properties['faction'] = Utils::convertFaction($unique['faction']);
    $properties['name'] = $unique['name'];
    // $properties['type'] = constant($unique['cardType']['reference']);
    $properties['type'] = constant($unique['cardType']);

    $subtypes = [];
    $typeline = [];

    // old
    // foreach ($unique['cardSubTypes'] ?? [] as $v => $sub) {
    //   // ?? [] is temp!
    //   $subtypes[] = constant($sub['reference']);
    //   $typeline[] = $sub['name'];
    // }
    foreach ($unique['subTypes'] ?? [] as $v => $sub) {
      // ?? [] is temp!
      $subtypes[] = constant($sub);
    }
    foreach ($unique['typeline'] ?? [] as $v => $sub) {
      // ?? [] is temp!
      $typeline[] = clienttranslate($sub);
    }
    $properties['subtypes'] = $subtypes;
    $properties['typeline'] = implode(' - ', $typeline);
    // $properties['artist'] = $unique['illustrator']['nickName']; old
    $properties['artist'] = $unique['illustrator'];

    // old
    // $properties['costHand'] = (int) $unique['elements']['MAIN_COST'];
    // $properties['costReserve'] = (int) $unique['elements']['RECALL_COST'];
    // $properties['forest'] = (int) $unique['elements']['FOREST_POWER'];
    // $properties['mountain'] = (int) $unique['elements']['MOUNTAIN_POWER'];
    // $properties['ocean'] = (int) $unique['elements']['OCEAN_POWER'];

    $properties['costHand'] = $unique['costHand'];
    $properties['costReserve'] = $unique['costReserve'];
    $properties['forest'] = $unique['forest'];
    $properties['mountain'] = $unique['mountain'];
    $properties['ocean'] = $unique['ocean'];

    // add effects
    $properties['uEffects'] = [];
    foreach ($unique['uniqueReduced'] as $i => $cardElement) {
      // throw new \feException(print_r($cardElement));
      $trinity = [];
      // throw new \feException(print_r($cardElement));
      foreach ($cardElement['effects'] as $i => $effect) {
        $trinity = [];
        foreach ($effect as $j => $idGd) {
          if (in_array($idGd, TRIGGER)) {
            $trinity['trigger'] = $idGd;
          } elseif (in_array($idGd, \CONDITION)) {
            $trinity['condition'] = $idGd;
          } elseif (in_array($idGd, OUTPUT)) {
            $trinity['output'] = $idGd;
          }
        }
        if (empty($trinity)) {
          continue;
        }
        if (count($trinity) != 3) {
          // throw new \feException(print_r($effect));
          return null;
        }
        // var_dump($trinity);
        $valid = FlowConvertor::constructEffect($trinity, $properties);
        // var_dump($properties);
        // throw new \feException(print_r($trinity));
        $properties['uEffects'][] = array_values($trinity);
        // throw new \feException(print_r($properties));
      }
    }
    // $debug[0] = $unique;
    // $debug[1] = $properties;
    // throw new \feException(print_r($properties));
    return $properties;
  }

  public static function generateRandomUnique($faction)
  {
    require_once dirname(__FILE__) . '/../Cards/cards.inc.php';

    $found = false;
    $cardO = null;
    $cardList = array_keys(MAP_REFS_CLASSES);
    do {
      $card = $cardList[array_rand($cardList)];
      $cardO = self::getCardClass($card);

      if ($cardO->getFaction() != $faction || $cardO->getType() != CHARACTER || $cardO->getRarity() != RARITY_COMMON) {
        continue;
      } else {
        $found = true;
      }
    } while ($found == false);
    $card = $cardO->jsonSerialize()['properties'];
    $card['rarity'] = RARITY_UNIQUE;
    $card['asset'] = substr($card['asset'], 0, strlen($card['asset']) - 1) . 'U';
    foreach (
      [
        'effectDesc',
        'supportDesc',
        'supportIcon',
        'effectHand',
        'effectReserve',
        'effectPlayed',
        'effectPassive',
        'gigantic',
        'defender',
        'oppositeDefender',
        'eternal',
        'dynamicDefender',
        'dynamicTough',
        'tough',
      ]
      as $eff
    ) {
      if (isset($card[$eff])) {
        unset($card[$eff]);
      }
    }
    $nbEffect = rand(1, 1);
    for ($i = 0; $i < $nbEffect; $i++) {
      $trinity = [];
      $trinity['trigger'] = TRIGGER[array_rand(TRIGGER)];
      $trinity['condition'] = CONDITION[array_rand(CONDITION)];
      $trinity['output'] = OUTPUT[array_rand(OUTPUT)];
      FlowConvertor::constructEffect($trinity, $card);
    }
    return $card;
  }

  public static function getUiData($pId, $refresh = false)
  {
    $current = Players::getCurrent() == null ? false : Players::getCurrent()->getId() == $pId;
    $currentPId = Players::getCurrent() == null ? -1 : Players::getCurrent()->getId();
    $cards = self::getAll()
      ->where('location', IN_PLAY)
      ->merge(self::getInLocation(RESERVE))
      ->merge(self::getInLocation('board-hero-%'))
      ->merge(self::getInLocation('limbo'))
      ->merge(self::getInLocation('discard'))
      ->merge(self::getInLocation('reveal-%'));

    if (!$refresh && $current) {
      $cards = $cards->merge(self::getHand($pId))->merge(self::getFiltered($pId, MANA));
    }
    $cards = $cards->merge(
      self::getAll()->where('location', HAND)
        ->filter(function ($c) use ($currentPId) {
          return $c->getPId() != $currentPId && $c->isRevealed();
        })
    );

    return $cards->orderBy('state')->toArray();
  }

  ///////////////////////////////////
  //  ____       _
  // / ___|  ___| |_ _   _ _ __
  // \___ \ / _ \ __| | | | '_ \
  //  ___) |  __/ |_| |_| | |_) |
  // |____/ \___|\__|\__,_| .__/
  //                      |_|
  ///////////////////////////////////

  public static function setupPrecoDeck($player, $deckNumber, $deckList)
  {
    // Load list of cards
    require_once dirname(__FILE__) . '/../Cards/cards.inc.php';

    $toCreate = [];
    $pId = $player->getId();

    foreach (FACTIONS as $faction) {
      $deck = Globals::getBeginner() == OPTION_DEMO ? DEMO[$faction] : STARTER[$faction];

      foreach ($deck as $cardId => $n) {
        // require_once dirname(__FILE__) . '/../Cards/' . $faction . '/' . $cardId . '.php';
        $className = "\\ALT\\Cards\\$faction\\$cardId";
        $card = new $className(null);
        $location = "deck-$deckNumber";
        if ($card->getType() == HERO) {
          $deckList[$deckNumber] = ['deckNum' => $deckNumber, 'faction' => $faction];
        }

        // we do not create token as they will be created on the fly
        if ($card->isToken()) {
          continue;
        }

        $toCreate[] = [
          'player_id' => $pId,
          'location' => $location,
          'nbr' => $n,
          'properties' => [
            'rarity' => $card->getRarity(),
            'name' => $card->getName(),
            'faction' => $card->getFaction(),
          ],
        ];
      }
      $deckNumber++;
    }

    self::create($toCreate, null);
    return $deckList;
    // self::shuffle('deck-' . $pId);
  }

  public static function createDeck($player, $deckContent)
  {
    // Load list of cards
    $toCreate = [];
    $pId = $player->getId();
    $faction = '';

    $toCreate[] = [
      'player_id' => $pId,
      'location' => 'board-hero-' . $pId,
      'nbr' => 1,
      'properties' => $deckContent[HERO]['card']['properties'],
    ];
    $faction = $deckContent[HERO]['card']['properties']['faction'];
    $location = 'deck-API';
    foreach ($deckContent as $cardInfo) {
      $card = new Card($cardInfo['card']);

      // we do not create token as they will be created on the fly
      if ($card->isToken()) {
        continue;
      }

      $toCreate[] = [
        'player_id' => $pId,
        'location' => $location,
        'nbr' => $cardInfo['n'],
        'properties' => $card->getProperties(),
      ];
      // $faction = $card->getFaction();
    }
    self::create($toCreate, null);

    if (($deckContent[HERO]['card']['properties']['createMarkers'] ?? false) == true) {
      Meeples::createHeroMarkers();
    }

    return $faction;
  }

  public static function shuffleDeck($location)
  {
    $player = Players::get(explode('-', $location)[1]);
    Notifications::shuffleDeck($player, $location, self::countInLocation($location));
    Notifications::refreshUI(Game::get()->getAllDatas(true));
  }

  /**
   * Get all cards played by player matching the given type
   */
  public static function getPlayedCards($pId, $type = null)
  {
    return self::getFiltered($pId, IN_PLAY, $type)->orderBy('state', 'ASC');
  }

  public static function getReserveCards($pId, $type = null)
  {
    return self::getFiltered($pId, RESERVE, $type);
  }

  public static function getStormCards($pId, $type = null)
  {
    return self::getFiltered($pId, 'storm%', $type);
  }

  public static function getHand($pId, $type = null)
  {
    return self::getFiltered($pId, 'hand', $type)->orderBy('state', 'ASC');
  }

  public static function getManaChoice($pId)
  {
    return self::getFiltered($pId, 'choice')->orderBy('state', 'ASC');
  }

  /**
   * Check whether a player played a specific card
   */
  public static function hasPlayedCard($pId, $id)
  {
    $card = self::getSingle($id, false);
    return !is_null($card) && $card->isPlayed() && $card->getPId() == $pId;
  }

  public static function discard($cardIds, $discard = 'discard', $pId = null)
  {
    if (!is_null($pId)) {
      $discard = $discard . '_' . $pId;
    }
    return self::move($cardIds, $discard);
  }

  // Used during new day
  public static function untapAll()
  {
    $untapped = [];
    $exhaustedCharactersMorning = Players::isExhaustedCharactersMorning();
    foreach (self::getAll() as $cId => $card) {
      if (!is_null($card) && $card->isTapped()) {
        if (
          !$exhaustedCharactersMorning ||
          ($exhaustedCharactersMorning && (!in_array($card->getType(), [TOKEN, CHARACTER]) || $card->getLocation() != RESERVE))
        ) {
          $card->setTapped(false);
          $untapped[] = $cId;
        }
      }
    }
    Notifications::untap($untapped);
  }

  ///////////////////////////////////////
  //  _____                 _
  // | ____|_   _____ _ __ | |_ ___
  // |  _| \ \ / / _ \ '_ \| __/ __|
  // | |___ \ V /  __/ | | | |_\__ \
  // |_____| \_/ \___|_| |_|\__|___/
  ///////////////////////////////////////

  /**
   * Get all the cards triggered by an event
   */
  public static function getListeningCards($event)
  {
    $cards = self::getListeningCardsObject()
      ->filter(function ($card) use ($event) {
        return $card->isListeningTo($event);
      })
      ->getIds();

    // if we force other cards to be listened to
    if (isset($event['cardsToListen'])) {
      $cards = array_merge(
        $cards,
        Cards::getMany($event['cardsToListen'], false)
          ->filter(function ($card) use ($event, $cards) {
            return !in_array($card->getId(), $cards) && $card->isListeningTo($event);
          })
          ->getIds()
      );
    }

    if (isset($event['reserveToListen'])) {
      $cards = array_merge(
        $cards,
        Cards::getMany($event['reserveToListen'], false)
          ->filter(function ($card) use ($event, $cards) {
            return !in_array($card->getId(), $cards) && $card->isListeningTo($event);
          })
          ->getIds()
      );
    }

    return $cards;
  }

  public static function getListeningCardsObject()
  {
    return self::getInLocation(STORM_LEFT)
      ->merge(self::getInLocation(STORM_RIGHT))
      ->merge(self::getInLocation(LANDMARK))
      ->merge(self::getInLocation(RESERVE))
      ->merge(self::getInLocation('board-hero%'));
  }

  /**
   * Get reaction in form of an ARRAY of node that can be used to activate a card
   */
  public static function getReaction($event, $returnNullIfEmpty = true, $ownerPId = true)
  {
    $listeningCards = self::getListeningCards($event);
    if (empty($listeningCards) && $returnNullIfEmpty) {
      return null;
    }
    // throw new \feException(print_r($listeningCards));
    $childs = [];
    $backupEvent = $event;
    foreach ($listeningCards as $cardId) {
      $event = $backupEvent;
      $listenCard = self::get($cardId);
      if ($listenCard->getLocation() == RESERVE) {
        $event['reserveToListen'][] = $cardId;
      }
      // #147483: "Unique lyra - Timing limbo effect/cleanup
      if (isset($event['action']) && in_array($listenCard, STORMS) && ($listenCard->getEffectPassive()[$event['action']]['forceListening'] ?? false) == true) {
        $event['cardsToListen'] = array_merge($event['cardsToListen'] ?? [], [$cardId]);
      }
      $event['sourceLocation'] = self::get($cardId)->getLocation();
      $childs[] = [
        'action' => ACTIVATE_CARD,
        // 'pId' => $event['pId'],
        'pId' => $ownerPId == true ? self::get($cardId)->getPId() : $event['pId'],
        'args' => [
          'cardId' => $cardId,
          'event' => $event,
        ],
      ];
    }
    if (empty($childs) && $returnNullIfEmpty) {
      return null;
    }
    // return [
    //   'type' => NODE_PARALLEL,
    //   'pId' => $event['pId'],
    //   'childs' => $childs,
    // ];
    return $childs;
  }

  public static function getAltArt()
  {
    return [
      'ALT_COREKS_B_AX_07' => [
        'flavorText' => clienttranslate('These nameless workers are crucial to the Foundry\'s day-to-day operations.'),
      ],
      'ALT_COREKS_B_AX_18' => ['flavorText' => clienttranslate('"Down from the skies, I come to check your rage."')],
      'ALT_COREKS_B_BR_07' => ['flavorText' => clienttranslate('"Gotta go fast!"')],
      'ALT_COREKS_B_BR_22' => [
        'flavorText' => clienttranslate(
          'To attract good fortune, spend new coin on an old friend, share an old pleasure with a new friend, and lift up the heart of a true friend by writing his name on the wings of a dragon.'
        ),
      ],
      'ALT_COREKS_B_LY_09' => ['flavorText' => clienttranslate('"Never trust the Tanuki twice." - Lyra proverb')],
      'ALT_COREKS_B_LY_21' => ['flavorText' => clienttranslate('"My fourth Unique card? No idea what you\'re talking about."')],
      'ALT_COREKS_B_MU_08' => ['flavorText' => clienttranslate('Little fella\'s got so mushroom in his heart.')],
      'ALT_COREKS_B_MU_09' => [
        'flavorText' => clienttranslate('We look on with benevolent eyes, not knowing what its future holds.'),
      ],
      'ALT_COREKS_B_OR_20' => ['flavorText' => clienttranslate('A soul for a soul.')],
      'ALT_COREKS_B_OR_21' => [
        'flavorText' => clienttranslate(
          '"I think you have forgotten something. We keep a merry inn here in the greenwood, but whoever becomes our guest must pay his reckoning."'
        ),
      ],
      'ALT_COREKS_B_YZ_11' => ['flavorText' => clienttranslate('The real scarecrow is not who you think.')],
      'ALT_COREKS_B_YZ_17' => ['flavorText' => clienttranslate('In the abyssal depths, no one can hear you scream.')],
      // Alizé
      'ALT_ALIZE_A_AX_35' => ['flavorText' => clienttranslate('Even over 50 years after her death, her pioneering research in the use of kelon is mentioned in all the history books.')],
      'ALT_ALIZE_A_BR_37' => ['flavorText' => clienttranslate('"Every scar marks a defeat, and every sword is a trophy."')],
      'ALT_ALIZE_A_LY_34' => ['flavorText' => clienttranslate('"This trick was a triumph. It’s hard to overstate my satisfaction."')],
      'ALT_ALIZE_A_MU_35' => ['flavorText' => clienttranslate('"This will be a fine addition to my collection."')],
      'ALT_ALIZE_A_OR_38' => ['flavorText' => clienttranslate('"Day 28. The intense cold is putting the troops\' morale to the test. I hope the dawn will bring a bit of warmth."')],
      'ALT_ALIZE_A_YZ_36' => ['flavorText' => clienttranslate('She used her body as a rampart until she was carried away by the waves.')],

    ];
  }

  /**
   * Go trough all played cards to apply effects
   */
  public static function getAllCardsWithMethod($methodName)
  {
    return self::getListeningCardsObject()->filter(function ($card) use ($methodName) {
      return \method_exists($card, 'on' . $methodName) ||
        \method_exists($card, 'onPlayer' . $methodName) ||
        \method_exists($card, 'onOpponent' . $methodName);
    });
  }

  public static function applyEffects($player, $methodName, &$args)
  {
    // Compute a specific ordering if needed
    $cards = self::getAllCardsWithMethod($methodName)->toAssoc();
    $nodes = array_keys($cards);
    $edges = [];
    $orderName = 'order' . $methodName;
    foreach ($cards as $cId => $card) {
      if (\method_exists($card, $orderName)) {
        foreach ($card->$orderName() as $constraint) {
          $cId2 = $constraint[1];
          if (!in_array($cId2, $nodes)) {
            continue;
          }
          $op = $constraint[0];

          // Add the edge
          $edge = [$op == '<' ? $cId : $cId2, $op == '<' ? $cId2 : $cId];
          if (!in_array($edge, $edges)) {
            $edges[] = $edge;
          }
        }
      }
    }
    $topoOrder = Utils::topological_sort($nodes, $edges);
    $orderedCards = [];
    foreach ($topoOrder as $cId) {
      $orderedCards[] = $cards[$cId];
    }

    // Apply effects
    $result = false;
    foreach ($orderedCards as $card) {
      $res = self::applyEffect($card, $player, $methodName, $args, false);
      $result = $result || $res;
    }
    return $result;
  }

  public static function applyEffect($card, $player, $methodName, &$args, $throwErrorIfNone = false)
  {
    $card = $card instanceof \ALT\Models\Card ? $card : self::get($card);
    $res = null;
    $listened = true;
    $isPlayerEvent = $player->getId() == $card->getPId();
    $node = ['type' => NODE_SEQ, 'optional' => true, 'childs' => []];

    list($payment, $output) = $card->getReactions($args);
    // throw new \feException(print_r($output));
    if (is_null($output) || empty($output)) {
      $listened = false;
      return null;
    }

    // if ($player != null && $isPlayerEvent && \method_exists($card, 'onPlayer' . $methodName)) {
    //   $n = 'onPlayer' . $methodName;
    //   $res = $card->$n($player, $args);
    // } elseif ($player != null && !$isPlayerEvent && \method_exists($card, 'onOpponent' . $methodName)) {
    //   $n = 'onOpponent' . $methodName;
    //   $res = $card->$n($player, $args);
    // } elseif (\method_exists($card, 'on' . $methodName)) {
    //   $n = 'on' . $methodName;
    //   $res = $card->$n($player, $args);
    // } else {
    //   $listened = false;
    // }

    if ($throwErrorIfNone && !$listened) {
      // throw new \feException(print_r(debug_print_backtrace()));
      throw new \BgaVisibleSystemException(
        'Trying to apply effect of a card without corresponding listener : ' . $methodName . ' ' . $card->getId()
      );
    }

    if (!is_null($payment) && !empty($payment)) {
      Utils::tagTree($payment, ['sourceId' => $card->getId()]);
      $node['childs'][] = $payment;
    }

    if (!is_null($output) && !empty($output)) {
      Utils::tagTree($output, ['sourceId' => $card->getId()]);
      if (is_null($payment) || empty($payment)) {
        return $output;
      }
      $node['childs'][] = $output;
    }

    return $node;
  }
}
