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

class Cards extends \ALT\Helpers\Pieces
{
  protected static $table = 'cards';
  protected static $prefix = 'card_';
  protected static $customFields = ['player_id', 'initial_properties', 'properties'];
  protected static $autoIncrement = true;
  protected static $autoremovePrefix = false;
  protected static $autoreshuffle = true;
  protected static $autoreshuffleCustom = ['deck' => 'discard'];

  protected static function cast($card)
  {
    return self::getCardInstance($card['card_id'], $card);
  }

  public static function getCardInstance($id, $data = null)
  {
    // TODO : remove once stable
    $p = json_decode($data['properties'], true);
    $faction = $p['faction'];
    $rarity = $p['rarity'] == 0 ? 'base' : 'rare';
    $slug = slugify($p['name']);
    $className = '\\ALT\\Cards\\' . $faction . '\\' . $faction . '_' . ucfirst($rarity) . '_' . $slug;
    return new $className($data);
    // return new Card($data);
  }

  public static function getUiData()
  {
    return self::getAll()
      ->where('location', IN_PLAY)
      ->merge(self::getInLocation(MEMORY))
      ->merge(self::getInLocation('board-alterateur-%'))
      ->toArray();
  }

  ///////////////////////////////////
  //  ____       _
  // / ___|  ___| |_ _   _ _ __
  // \___ \ / _ \ __| | | | '_ \
  //  ___) |  __/ |_| |_| | |_) |
  // |____/ \___|\__|\__,_| .__/
  //                      |_|
  ///////////////////////////////////

  public static function setupPrecoDeck($player)
  {
    // Load list of cards
    require_once dirname(__FILE__) . '/../Cards/cards.inc.php';

    $toCreate = [];
    $pId = $player->getId();
    $faction = $player->getFaction();
    $deck = PRECOS[$faction];
    foreach ($deck as $cardId => $n) {
      // require_once dirname(__FILE__) . '/../Cards/' . $faction . '/' . $cardId . '.php';
      $className = "\\ALT\\Cards\\$faction\\$cardId";
      $card = new $className(null);
      $location = "deck-$pId";
      if ($card->getType() == ALTERATEUR) {
        $location = "board-alterateur-$pId";
      }
      if (in_array($cardId, TOKENS)) {
        $location = "tokens-$pId";
      }
      // we do not create token as they will be created on the fly
      if ($card->isToken()) {
        continue;
      }

      $toCreate[] = [
        'player_id' => $pId,
        'location' => $location,
        'nbr' => $n,
        'properties' => $card->getProperties(),
      ];
    }

    self::create($toCreate, null);
    self::shuffle('deck-' . $pId);
  }

  /**
   * Get all cards played by player matching the given type
   */
  public static function getPlayedCards($pId, $type = null)
  {
    return self::getFiltered($pId, IN_PLAY)->filter(function ($card) use ($type) {
      return $type == null || $card->getType() == $type;
    });
  }

  public static function getMemoryCards($pId, $type = null)
  {
    return self::getFiltered($pId, MEMORY)->filter(function ($card) use ($type) {
      return $type == null || $card->getType() == $type;
    });
  }

  public static function getStormCards($pId, $type = null)
  {
    return self::getFiltered($pId, 'storm%')->filter(function ($card) use ($type) {
      return $type == null || $card->getType() == $type;
    });
  }

  public static function getHand($pId, $type = null)
  {
    return self::getFilteredQuery($pId, 'hand')
      ->orderBy(['card_state', 'ASC'])
      ->get()
      ->filter(function ($card) use ($type) {
        return $type == null || $card->getType() == $type;
      });
  }

  public static function getManaChoice($pId)
  {
    return self::getFilteredQuery($pId, 'choice')
      ->orderBy(['card_state', 'ASC'])
      ->get();
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
  public function getListeningCards($event)
  {
    return self::getListeningCardsObject()
      ->filter(function ($card) use ($event) {
        return $card->isListeningTo($event);
      })
      ->getIds();
  }

  public function getListeningCardsObject()
  {
    return self::getInLocation(STORM_LEFT)
      ->merge(self::getInLocation(STORM_RIGHT))
      ->merge(self::getInLocation(PERMANENT))
      ->merge(self::getInLocation('board-alterateur%'));
  }

  /**
   * Get reaction in form of an ARRAY of node that can be used to activate a card
   */
  public function getReaction($event, $returnNullIfEmpty = true)
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

    return [
      'type' => NODE_PARALLEL,
      'pId' => $event['pId'],
      'childs' => $childs,
    ];
  }

  /**
   * Go trough all played cards to apply effects
   */
  public function getAllCardsWithMethod($methodName)
  {
    return self::getListeningCardsObject()->filter(function ($card) use ($methodName) {
      return \method_exists($card, 'on' . $methodName) ||
        \method_exists($card, 'onPlayer' . $methodName) ||
        \method_exists($card, 'onOpponent' . $methodName);
    });
  }

  public function applyEffects($player, $methodName, &$args)
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

  public function applyEffect($card, $player, $methodName, &$args, $throwErrorIfNone = false)
  {
    $card = $card instanceof \ALT\Models\Card ? $card : self::get($card);
    $res = null;
    $listened = true;
    $isPlayerEvent = $player->getId() == $card->getPId();

    if ($player != null && $isPlayerEvent && \method_exists($card, 'onPlayer' . $methodName)) {
      $n = 'onPlayer' . $methodName;
      $res = $card->$n($player, $args);
    } elseif ($player != null && !$isPlayerEvent && \method_exists($card, 'onOpponent' . $methodName)) {
      $n = 'onOpponent' . $methodName;
      $res = $card->$n($player, $args);
    } elseif (\method_exists($card, 'on' . $methodName)) {
      $n = 'on' . $methodName;
      $res = $card->$n($player, $args);
    } else {
      $listened = false;
    }

    if ($throwErrorIfNone && !$listened) {
      throw new \BgaVisibleSystemException(
        'Trying to apply effect of a card without corresponding listener : ' . $methodName . ' ' . $card->getId()
      );
    }
    if (!is_null($res)) {
      Utils::tagTree($res, ['sourceId' => $card->getId()]);
    }

    return $res;
  }
}
