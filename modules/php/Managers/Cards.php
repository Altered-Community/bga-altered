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

class Cards extends \ALT\Helpers\Pieces
{
  protected static $table = 'cards';
  protected static $prefix = 'card_';
  protected static $customFields = [
    'player_id',
    'extra_datas',
    'type',
    'tapped',
    'costHand',
    'costMemory',
    'card_name',
    'rarity',
    'equinoxId',
    'mountain',
    'forest',
    'water',
    'boostEffect',
    'faction',
    'effectEcho',
    'effectHand',
    'effectMemory',
    'effectPassive',
    'costModifier',
    'initial_properties',
    'properties',
  ];
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
    $t = explode('_', $id);
    // First part before _ specify the type and the numbering
    // $prefixes = [
    //     'A' => 'Animals',
    //     'S' => 'Sponsors',
    //     'P' => 'Projects',
    //     'F' => 'FinalScoring',
    // ];
    // $prefix = $prefixes[$t[0][0]];
    // $className = "\ALT\Cards\\$prefix\\$id";
    return new Card($data);
  }

  public static function getUiData()
  {
    return [];
  }

  ///////////////////////////////////
  //  ____       _
  // / ___|  ___| |_ _   _ _ __
  // \___ \ / _ \ __| | | | '_ \
  //  ___) |  __/ |_| |_| | |_) |
  // |____/ \___|\__|\__,_| .__/
  //                      |_|
  ///////////////////////////////////

  /* Creation of the cards */
  public static function setupNewGame($players, $options)
  {
    // Load list of cards
    include dirname(__FILE__) . '/../Cards/cards.inc.php';

    $toCreate = [];
    foreach ($players as $pId => $player) {
      foreach ($cards as $cId => $card) {
        $card['player_id'] = $pId;
        $card['location'] = 'deck_' . $pId;
        $toCreate[] = $card;
      }
    }

    self::create($toCreate, null);
    foreach ($players as $pId => $player) {
      self::shuffle('deck_' . $pId);
    }
    // self::shuffle('scoringDeck');
  }

  /**
   * Get all cards played by player matching the given type
   */
  public static function getPlayedCards($pId, $type = null)
  {
    return self::getFiltered($pId, 'inPlay')->filter(function ($card) use ($type) {
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

  public static function discard($cardIds, $discard = 'discard')
  {
    return self::move($cardIds, $discard);
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
    return self::getInLocation('inPlay')
      //->merge(self::getInLocation('hand')) Removing hand cards as shouldn't have listeners on hand
      ->filter(function ($card) use ($event) {
        return $card->isListeningTo($event);
      })
      ->getIds();
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

    return $childs;
  }

  /**
   * Get reaction to icons
   */
  public function getIconsReaction($icons, $player, $splitImmediateAndAfter = false)
  {
    $cards = self::getInLocation('inPlay')->filter(function ($card) {
      return \method_exists($card, 'getIconsReaction');
    });
    $immediateChilds = [];
    $afterChilds = [];
    foreach ($cards as $card) {
      $bonuses = $card->getIconsReaction($icons, $player->getId() == $card->getPId());
      if (empty($bonuses)) {
        continue;
      }

      // $child = [
      //     'action' => ACTIVATE_CARD,
      //     'pId' => $player->getId(),
      //     'args' => [
      //         'cardId' => $card->getId(),
      //         'event' => [
      //             'icons' => $icons,
      //             'method' => 'playIcons',
      //         ],
      //     ],
      // ];

      // if ($card->getId() == 'S214_ExpertOnAfrica') {
      //     $child['afterFinishing'] = true;
      //     $afterChilds[] = $child;
      // } else {
      //     $immediateChilds[] = $child;
      // }
    }

    return $splitImmediateAndAfter ? [$immediateChilds, $afterChilds] : array_merge($immediateChilds, $afterChilds);
  }

  /**
   * Go trough all played cards to apply effects
   */
  public function getAllCardsWithMethod($methodName)
  {
    return self::getInLocation('inPlay')->filter(function ($card) use ($methodName) {
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

    if ($methodName == 'playIcons') {
      // list($immediate, $after) = FlowConvertor::getFlow(
      //     $card->getIconsReaction($args['icons'], $isPlayerEvent)
      // );
      // $res =
      //     count($immediate) > 1
      //         ? [
      //             'type' => \NODE_PARALLEL,
      //             'childs' => $immediate,
      //         ]
      //         : (empty($immediate)
      //             ? $after[0] ?? null
      //             : $immediate[0]);
    } elseif ($methodName == 'getIncome') {
      // $income = $card->getIncome();
      // foreach ($income as &$bonus) {
      //     $bonus['income'] = true;
      // }
      // list($immediate, $after) = FlowConvertor::getFlow($income);
      // $res =
      //     count($immediate) > 1
      //         ? [
      //             'type' => \NODE_PARALLEL,
      //             'childs' => $immediate,
      //         ]
      //         : (empty($immediate)
      //             ? $after[0] ?? null
      //             : $immediate[0]);
    } elseif ($player != null && $isPlayerEvent && \method_exists($card, 'onPlayer' . $methodName)) {
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
