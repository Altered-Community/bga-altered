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
    $p = json_decode($data['properties'], true);
    $faction = $p['faction'];
    $rarity = $p['rarity'] == 0 ? 'common' : 'rare';
    $slug = slugify($p['name']);
    $className = '\\ALT\\Cards\\' . $faction . '\\' . $faction . '_' . ucfirst($rarity) . '_' . $slug;

    $isUnique = false;
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

  public static function getCardClass($uid)
  {
    require_once dirname(__FILE__) . '/../Cards/cards.inc.php';
    if (!isset(MAP_REFS_CLASSES[$uid])) {
      throw new \BgaVisibleSystemException('This card is not implemented ' . $uid);
    }
    $cInfo = explode('/', MAP_REFS_CLASSES[$uid]);
    $className = "\\ALT\\Cards\\$cInfo[0]\\$cInfo[1]";
    return new $className(null);
  }

  public static function generateRandomDeck($player)
  {
    require_once dirname(__FILE__) . '/../Cards/cards.inc.php';
    $faction = FACTIONS[array_rand(FACTIONS)];
    $deckContent = [];

    $deckContent[HERO] = [
      'card' => Cards::getCardClass(HEROES[$faction][array_rand(HEROES[$faction])])->jsonSerialize(),
      'n' => 1,
    ];
    // random cards of the faction
    $i = 0;
    $totalCards = Globals::getTestingOption() ? 80 : 40;

    do {
      // $c = RELEASED[array_rand(RELEASED)];
      $c = array_rand(MAP_REFS_CLASSES);

      // $c = MAP_REFS_CLASSES[$a];
      // var_dump($c);
      $objCard = self::getCardClass($c);
      if ($objCard->getFaction() == $faction && $objCard->getType() != HERO) {
        $deckContent[] = ['card' => $objCard->jsonSerialize(), 'n' => 1];
        $i++;
      }
    } while ($i < $totalCards);
    return self::createDeck($player, $deckContent);
  }

  public static function getUiData($pId, $refresh = false)
  {
    $current = Players::getCurrent() == null ? false : Players::getCurrent()->getId() == $pId;
    $cards = self::getAll()
      ->where('location', IN_PLAY)
      ->merge(self::getInLocation(RESERVE))
      ->merge(self::getInLocation('board-hero-%'))
      ->merge(self::getInLocation('limbo'))
      ->merge(self::getInLocation('discard'));

    if (!$refresh && $current) {
      $cards = $cards->merge(self::getHand($pId))->merge(self::getFiltered($pId, MANA));
    }

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
      $deck = Globals::getDeckOptions() == OPTION_DECKS_DEMO ? DEMO[$faction] : STARTER[$faction];

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
      $faction = $card->getFaction();
    }
    self::create($toCreate, null);
    return $faction;
  }

  public static function shuffleDeck($location)
  {
    $player = Players::get(explode('-', $location)[1]);
    Notifications::shuffleDeck($player, $location, self::countInLocation($location));
  }

  /**
   * Get all cards played by player matching the given type
   */
  public static function getPlayedCards($pId, $type = null)
  {
    return self::getFiltered($pId, IN_PLAY, $type);
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
    foreach (self::getAll() as $cId => $card) {
      if ($card->isTapped()) {
        $card->setTapped(false);
        $untapped[] = $cId;
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
          ->filter(function ($card) use ($event) {
            return $card->isListeningTo($event);
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
      ->merge(self::getInLocation('board-hero%'));
  }

  /**
   * Get reaction in form of an ARRAY of node that can be used to activate a card
   */
  public static function getReaction($event, $returnNullIfEmpty = true)
  {
    $listeningCards = self::getListeningCards($event);
    if (empty($listeningCards) && $returnNullIfEmpty) {
      return null;
    }

    $childs = [];
    foreach ($listeningCards as $cardId) {
      $childs[] = [
        'action' => ACTIVATE_CARD,
        'pId' => $event['pId'],
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
