<?php
namespace ALT\Helpers;
use ALT\Core\Globals;
use ALT\Managers\Players;

// Allow to use a short flow description syntax
abstract class FlowConvertor
{
  /**
   * getFlow: given an array of bonuses, return the list of corresponding actions
   *  - array of bonuses follow this format :
   *    [
   *      [BONUS_TYPE => BONUS_N],
   *      [BONUS_TYPE => BONUS_N]
   *    ]
   */
  public function getFlow($bonuses, $source = '', $sourceType = null, $sourceId = null)
  {
    $immediateBonuses = [];
    $afterFinishingBonuses = [];
    foreach ($bonuses as $bonus) {
      // If bonus is already a node, no conversion needed
      if (isset($bonus['action']) || (isset($bonus['type']) && isset($bonus['childs']))) {
        if ($bonus['afterFinishing'] ?? false) {
          $afterFinishingBonuses[] = $bonus;
        } else {
          $immediateBonuses[] = $bonus;
        }
        continue;
      }

      $type = array_keys($bonus)[0];
      $n = $bonus[$type];
      $bonus['sourceId'] = $sourceId;
      $node = self::getFlowSingleBonus($type, $n, $bonus['source'] ?? $source, $bonus['sourceId'] ?? $sourceId, $bonus);

      // TODO : check later on
      // if (in_array($type, [CLEVER, DETERMINATION]) || ($bonus['afterFinishing'] ?? false)) {
      //   $afterFinishingBonuses[] = $node;
      // } else {
      $immediateBonuses[] = $node;
      // }
    }
    return [$immediateBonuses, $afterFinishingBonuses];
  }

  /**
   * getFlowSingleBonus: given a bonus with its type and n, return the corresponding action
   */
  public static function getFlowSingleBonus($type, $n, $source = '', $sourceId = null, $args = [])
  {
    $flow = self::getFlowSingleBonusAux($type, $n, $args);
    $data = [];
    if (!is_null($sourceId)) {
      $data['sourceId'] = $sourceId;
    } elseif (!is_null($source) && $source != '') {
      $data['source'] = $source;
    }

    return Utils::tagTree($flow, $data);
  }

  public static function getFlowSingleBonusAux($type, $n, $args = [])
  {
    // Basic counters via GAIN action
    if (in_array($type, [FLEETING, BOOST, GIGANTIC, ANCHORED, ASLEEP])) {
      // Handle the case of giving stuff to everyone else
      if (($args['pId'] ?? null) == \EVERYONE_ELSE) {
        $childs = [];
        $player = Players::getActive();
        foreach (Players::getAll() as $pId => $player2) {
          if ($pId == $player->getId()) {
            continue;
          }
          $childs[] = [
            'action' => GAIN,
            'args' => [$type => $n, 'pId' => $pId],
          ];
        }

        return [
          'type' => \NODE_SEQ,
          'childs' => $childs,
        ];
      }

      // Normal gain
      $data = [
        'action' => GAIN,
        'args' => [$type => $n],
      ];
      if (isset($args['pId'])) {
        $data['args']['pId'] = $args['pId'];
      }
      if ($args['income'] ?? false) {
        $data['args']['income'] = true;
      }
      if (!isset($args['cardId']) && !is_null($args['sourceId'] ?? null)) {
        $data['args']['cardId'] = $args['sourceId'];
      }
      return $data;
    } elseif ($type == TARGET_ALL_EXPLORER) {
      // target will trigger a sequential node, with the args
      $childs = [];
      $childs[] = ['action' => TARGET, 'args' => []];
      foreach ($n as $id => $newNode) {
        $newType = array_keys($newNode)[0];
        $newN = $newNode[$newType];
        $childs[] = self::getFlowSingleBonusAux($newType, $newN);
      }
      return ['node' => NODE_SEQ, 'childs' => $childs];
    } elseif ($type == TARGET_ALL_EXPLORER_2) {
      // target will trigger a sequential node, with the args
      $childs = [];
      $childs[] = ['action' => TARGET, 'args' => ['n' => 2]];
      foreach ($n as $id => $newNode) {
        $newType = array_keys($newNode)[0];
        $newN = $newNode[$newType];
        $childs[] = self::getFlowSingleBonusAux($newType, $newN);
      }
      return ['node' => NODE_SEQ, 'childs' => $childs];
    } elseif ($type == TARGET_ALL_ALL_1_4) {
      // Target all characters or permanent, 1 card, 4 less, memory
      // target will trigger a sequential node, with the args
      $childs = [];
      $childs[] = [
        'action' => TARGET,
        'args' => ['targetType' => [EXPLORER, PERMANENT], 'targetLocation' => ['played', MEMORY], 'handCost' => 5],
      ];
      foreach ($n as $id => $newNode) {
        $newType = array_keys($newNode)[0];
        $newN = $newNode[$newType];
        $childs[] = self::getFlowSingleBonusAux($newType, $newN);
      }
      return ['node' => NODE_SEQ, 'childs' => $childs];
    } elseif ($type == SABOTAGE) {
      return [
        'type' => NODE_SEQ,
        'childs' => [
          ['action' => TARGET, 'args' => ['optional' => true, 'targetLocation' => [MEMORY]]],
          ['action' => DISCARD, 'args' => []],
        ],
      ];
    } elseif ($type == DISCARD_HAND) {
      return ['action' => DISCARD, 'args' => ['destination' => HAND]];
    } elseif ($type == DISCARD) {
      return ['action' => DISCARD, 'args' => ['n' => $n]];
    } elseif ($type == LOOSE) {
      $data = [
        'action' => LOOSE,
        'args' => [],
      ];

      foreach ($n as $res => $amount) {
        $data['args'][$res] = $data['args'][$res] ?? 0 + $amount;
      }

      if (!isset($args['cardId']) && !is_null($args['sourceId'] ?? null)) {
        $data['args']['cardId'] = $args['sourceId'];
      }
      return $data;
    }
    // // Addition worker => same as "Full Throated" animal effect
    // elseif ($type == \BONUS_WORKER) {
    //   return ['action' => FULL_THROATED, 'args' => ['n' => 1]];
    // }
    // // Move animals => only for the specific case where you build a special enclosure and you can move animals inside it
    // elseif ($type == MOVE_ANIMALS) {
    //   return [
    //     'action' => MOVE_ANIMALS,
    //     'args' => ['buildingType' => $n],
    //     'optional' => true,
    //   ];
    // }
    // // Upgrade an action card
    // elseif ($type == BONUS_UPGRADE_CARD) {
    //   return ['action' => UPGRADE_CARD];
    // }
    // // Gain a free university from the association board
    // elseif ($type == UNIVERSITY) {
    //   return ['action' => GAIN_UNIVERSITY];
    // }
    // // Gain a free partner zoo from the association board
    // elseif ($type == PARTNER_ZOO) {
    //   return ['action' => GAIN_PARTNER_ZOO];
    // }
    // // Build enclosure
    // elseif (in_array($type, array_merge(ENCLOSURES, [KIOSK, PAVILION]))) {
    //   if ($n > 1) {
    //     $nodes = [];
    //     for ($i = 0; $i < $n; $i++) {
    //       $nodes[] = ['action' => BUILD, 'args' => ['free' => true, 'freeBuilding' => $type, 'canPass' => true]];
    //     }
    //     return ['type' => NODE_SEQ, 'childs' => $nodes];
    //   }
    //   return [
    //     'action' => BUILD,
    //     'args' => ['free' => true, 'freeBuilding' => $type, 'canPass' => true],
    //   ];
    // } elseif ($type == BONUS_SPECIAL_ENCLOSURES) {
    //   return [
    //     'action' => BUILD,
    //     'args' => ['free' => true, 'freeBuilding' => [\LARGE_BIRD_AVIARY, \REPTILE_HOUSE], 'canPass' => true],
    //   ];
    // }
    // // Build unique building
    // elseif ($type == BUILD) {
    //   return [
    //     'action' => BUILD,
    //     'args' => ['free' => true, 'freeBuilding' => $n, 'unique' => true],
    //   ];
    // } elseif ($type == MULTIPLIER) {
    //   return ['action' => MULTIPLIER, 'args' => ['n' => 'all']];
    // }
    // // Pay a sponsor card with money instead of strength
    // elseif ($type == BONUS_SPONSOR) {
    //   return ['action' => BUY_SPONSOR, 'optional' => true];
    // }
    // // Everyone need to discard a scoring card
    // elseif ($type == DISCARD_SCORING) {
    //   $player = Players::getActive();
    //   return [
    //     'action' => DISCARD_SCORING,
    //     'args' => ['current' => $player->getId()],
    //     'pId' => 'all',
    //   ];
    // } elseif ($type == POUCH) {
    //   return ['action' => POUCH, 'args' => ['mapEffect' => true, 'n' => $n]];
    // } elseif ($type == CLEVER && ($n ?? 1) > 1) {
    //   $nodes = [];
    //   for ($i = 0; $i < $n; $i++) {
    //     $nodes[] = ['action' => CLEVER];
    //   }
    //   return ['type' => NODE_SEQ, 'childs' => $nodes];
    // }
    // Default behavior : action name = bonus name
    else {
      return ['action' => $type, 'args' => ['n' => $n]];
    }

    die('TakeBonus : bonus type flow not found for ' . $type);
  }
}
