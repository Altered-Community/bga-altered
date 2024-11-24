<?php

namespace ALT\Models;

use ALT\Managers\Players;
use ALT\Core\Game;
use ALT\Core\Globals;
use ALT\Core\Engine;
use ALT\Managers\Meeples;
use ALT\Core\Notifications;
use ALT\Helpers\Conditions;
use ALT\Helpers\FT;
use ALT\Helpers\Utils;

/*
 * Card
 */

class Card extends \ALT\Helpers\DB_Model
{
  protected $implemented = true; // For DEV only

  protected $table = 'cards';
  protected $primary = 'card_id';
  protected $attributes = [
    'id' => ['card_id', 'int'],
    'location' => 'card_location',
    'state' => ['card_state', 'int'],
    'pId' => ['player_id', 'int'],

    // attributs persistants
    'properties' => ['properties', 'obj'], // will superseed original properties if needed
  ];
  protected $id;
  protected $location;
  protected $state;
  protected $pId;
  protected $properties;

  protected $staticAttributes = [];
  protected $propertiesAttributes = [
    'equinoxId' => 'int',
    'faction' => 'str',
    'name' => 'str', // obj?
    'type' => 'str', // Token/hero/adventurer/spell
    'typeline' => 'str',
    'subtypes' => 'obj',
    'token' => 'bool',
    'uid' => 'str',
    'flavorText' => 'str',
    'effectDesc' => 'str',
    'supportDesc' => 'str',
    'supportIcon' => 'str',
    'artist' => 'str',
    'setIcon' => 'str',
    'thumbnail' => 'int', // Only used for Heros for UI
    'statData' => 'int',

    'rarity' => 'int',
    'asset' => 'str',
    'frame' => 'int',
    'reserveSlots' => 'int',
    'landmarkSlots' => 'int',

    'mountain' => 'int',
    'forest' => 'int',
    'ocean' => 'int',

    'costModifier' => 'obj', // ['hand'=> action check, 'reserve' => action check]
    'costHand' => 'int',
    'costReserve' => 'int',
    'costReductionDiscard' => 'int', // to manage possibilites to discard a card, to reduce cost to pay
    'dynamicCostReduction' => 'str',

    'effectPlayed' => 'obj', // Played, no mater from hand or reserve
    'effectHand' => 'obj', // played from hand
    'effectReserve' => 'obj', // played from reserve
    'effectSupport' => 'obj',
    'effectPassive' => 'obj', // [[listener type => action]]: listener type to distinguish
    'effectTap' => 'obj',

    'gigantic' => 'bool',
    'dynamicGigantic' => 'str',
    'fleeting' => 'bool',
    'seasoned' => 'bool',
    'minManaOrbs' => 'int', //used for cards that cannot be played unless specific amount of total mana
    'defender' => 'bool',
    'dynamicDefender' => 'str',
    'oppositeDefender' => 'bool', // OD_Common_Issitoq
    'dynamicOppositeDefender' => 'str',
    'eternal' => 'bool',
    'blockingPower' => 'bool',
    'dynamicBlockingPower' => 'str',
    'increaseOpponentCardsCost' => 'int',
    'increaseOpponentCharacterCost' => 'int',
    'increaseOpponentSpellCost' => 'int',
    'increaseOpponentPermanentCost' => 'int',
    'increaseOpponentTokenCost' => 'int',
    'opponentCharactersMinimumCost' => 'int',
    'opponentCardsMinimumCost' => 'int',
    'sacrificeAndNotFleetingGoToReserve' => 'bool',
    'sacrificeAndFleetingDraw' => 'bool',
    'updateExpeditions' => 'obj', // type = All, region []
    'blockAutomaticAction' => 'obj',
    'addDice' => 'int',
    'resupply2' => 'bool',

    // Tough management
    'tough' => 'int',
    'dynamicTough' => 'str',
    'excludeUniversalTough' => 'bool',
    'excludeSelfTough' => 'bool',
    'dynamicEternal' => 'str',
    'addRoll' => 'int',

    // Dynamic info
    'tapped' => 'bool',
    'extraDatas' => 'obj',

    // Alizé
    'playTappedCards' => 'obj', // ['type'=>ALL / Character, 'location'=>me or unset]
    'canAlwaysGainFleeting' => 'bool',
    'dynamicGainReplace' => 'obj',
    'defenderIgnoreBehind' => 'bool', // Ignore defender attribute when behind
    'ignoreDefender' => 'bool', // Mobile Armory
    'cooldown' => 'bool', // in spell cleanup, card will be tapped
    'exhaustedReserveSlots' => 'int',
    'costReductionIfEmpty' => 'int',
    'giganticOneCharacter' => 'bool', // If in only one exp, it is gigantic. Eat Me Energy Bars
    'opponentOceanOnly' => 'bool', // Will o the Wisp
    'opponentForestOnly' => 'bool', // Will o the Wisp
    'increaseBiomesHighest' => 'bool', // WinterOufits
    'advanceTwiceDusk' => 'bool', // Magic Sleigh
    'protectAnchoredInExpedition' => 'bool', // Floral tent
    'increaseReserveCost' => 'int', // Ebenezer Scrooge
    'reduceReserveCost' => 'int', // Ebenezer Scrooge

  ];

  /********* DB ACCESS *********/

  // Magic getter to test DB Field & properties field
  public function __call($method, $args)
  {
    if (preg_match('/^([gs]et|inc|is)([A-Z])(.*)$/', $method, $match)) {
      // Sanity check : does the name correspond to a declared variable ?
      $name = mb_strtolower($match[2]) . $match[3];

      // TODO put management of properties
      if (\array_key_exists($name, $this->propertiesAttributes)) {
        if ($match[1] == 'get') {
          $type = $this->propertiesAttributes[$name];
          if (isset($this->properties[$name])) {
            if (count($args) > 0 && $type == 'obj' && is_array($this->properties[$name])) {
              return $this->properties[$name][$args[0]];
            } else {
              return $this->properties[$name];
            }
          }
          // Default value
          else {
            if ($type == 'int') {
              return 0;
            }
            if ($type == 'bool') {
              return false;
            }
            if ($type == 'str') {
              return '';
            }
            if ($type == 'obj') {
              return [];
            }
          }
        } elseif ($match[1] == 'is') {
          if (!isset($this->properties[$name])) {
            return false;
          }
          // Boolean getter
          return (bool) $this->properties[$name];
        } elseif ($match[1] == 'set') {
          return $this->setProperty($name, $args[0]);
        }
      }
      // Default DB behavior
      else {
        return parent::__call($method, $args);
      }
    } else {
      return parent::__call($method, $args);
    }
  }

  public function getProperty($variable)
  {
    return $this->properties[$variable] ?? null;
  }

  public function setProperty($variable, $value, $updateDB = true)
  {
    $this->properties[$variable] = $value;
    if ($updateDB) {
      $this->setProperties($this->properties);
    }
  }

  public function isSupported($players, $options)
  {
    return $this->implemented;
  }

  public function getTypeStr()
  {
    return '';
  }

  public function getUiData()
  {
    // TODO: update
    return $this->jsonSerialize(); // Static datas are already in js file
  }

  public function isPlayed()
  {
    return $this->location == STORM_LEFT ||
      $this->location == STORM_RIGHT ||
      $this->location == LANDMARK ||
      $this->properties['type'] == HERO;
  }

  public function isMana()
  {
    return $this->location = 'mana';
  }

  public function getPlayer($checkPlayed = false)
  {
    if (!$this->isPlayed() && $checkPlayed) {
      throw new \feException("Trying to get the player for a non-played card : {$this->id}");
    }

    return Players::get($this->pId);
  }

  public function canBePlayed($player)
  {
    if (!$player->canPlayTappedCards($this->getType()) && $this->getLocation() == RESERVE && $this->isTapped()) {
      return false;
    }

    $cost = $this->getCost();
    $costReductionIfEmpty = $this->getCostReductionIfEmpty();
    $mana = $player->getMana();
    $totalMana = $player->getTotalMana();
    // Amarok case
    if ($costReductionIfEmpty > 0) {
      if (
        $player->countCardsInLocation(STORM_LEFT, [TOKEN, CHARACTER])  == 0 ||
        $player->countCardsInLocation(STORM_RIGHT, [TOKEN, CHARACTER]) == 0
      ) {
        $cost -= $costReductionIfEmpty;
      }
    }

    if ($this->getCostReductionDiscard() > 0) {
      $reserveCards = $this->getPlayer()
        ->getReserveCards()
        ->count();
      if ($this->getLocation() == RESERVE && $reserveCards >= 2) {
        $cost -= $this->getCostReductionDiscard();
      } elseif ($reserveCards >= 1) {
        $cost -= $this->getCostReductionDiscard();
      }
    }

    return $cost <= $mana && $this->getMinManaOrbs() <= $totalMana;
  }

  public function getPlayableLocation($player)
  {
    if (in_array(LANDMARK, $this->getSubtypes())) {
      return [LANDMARK];
    } elseif ($this->getType() == SPELL) {
      return [LIMBO];
    } else {
      $locations = [];
      if ($this->getLocation() == RESERVE && $this->isTapped()) {
        foreach (STORMS as $storm) {
          if ($player->canPlayTappedCards($this->getType(), $storm)) {
            $locations[] = $storm;
          }
        }
        return $locations;
      } else {
        if ($this->getCostReductionIfEmpty() > 0) {
          // If the cost can be paid no matter what, we put all storms
          if ($this->getCost() <= $player->getMana()) {
            return STORMS;
          }
          $locations = [];
          if ($player->countCardsInLocation(STORM_LEFT, [TOKEN, CHARACTER]) == 0) {
            $locations[] = STORM_LEFT;
          }
          if ($player->countCardsInLocation(STORM_RIGHT, [TOKEN, CHARACTER]) == 0) {
            $locations[] = STORM_RIGHT;
          }
          return $locations;
        } else {
          return STORMS;
        }
      }
    }
  }

  public function hasToken($token)
  {
    return $this->countToken($token) > 0;
  }

  public function countToken($token)
  {
    return Meeples::countMeeples('card-' . $this->id, $token);
  }

  public function getOfType($type)
  {
    return Meeples::getOfType('card-' . $this->id, $type);
  }

  public function discard()
  {
    return $this->discardTo(DISCARD_PILE);
  }

  public function moveToReserve()
  {
    return $this->discardTo(RESERVE);
  }

  public function discardTo($location)
  {
    $this->checkLeaveListener($location);
    $this->setLocation($location);
    $this->setTapped(false);

    // Remove meeples
    $meeples = Meeples::getInLocation('card-' . $this->id);
    if ($location == RESERVE && $this->isSeasoned()) {
      $meeples = $meeples->filter(fn($m) => $m->getType() != BOOST); // Seasoned card keep their boost
    }
    $meepleIds = $meeples->getIds();
    if (!empty($meepleIds)) {
      Meeples::delete($meepleIds);
    }

    // Clear counter
    if (!is_null($this->getExtraDatas()['counterName'] ?? null)) {
      $this->setExtraDatas([]);
      Notifications::deleteCounter($this);
    }

    return $meepleIds;
  }

  // deletes Token that must be removed at night
  public function nightCleanup()
  {
    $meepleIds = Meeples::getFiltered(null, 'card-' . $this->id, [ASLEEP, ANCHORED])->getIds();
    Meeples::delete($meepleIds);
    return $meepleIds;
  }

  public function checkLeaveListener($target)
  {
    $type = null;
    $location = $this->getLocation();
    if (in_array($location, STORMS)) {
      $type = 'LeaveExpedition';
    } elseif ($location == LANDMARK) {
      $type = 'LeaveLandmark';
    }

    $event = [
      'type' => $type,
      'method' => $type,
      'cardId' => $this->id,
      'from' => $this->getLocation(),
      'to' => $target,
      'boost' => $this->countToken(BOOST),
      'fleeting' => $this->hasToken(FLEETING),
    ];

    if ($this->isListeningTo($event)) {
      $event['cardsToListen'] = [$this->id];
      Engine::pushAfterFinishingChilds([
        [
          'action' => ACTIVATE_CARD,
          'args' => [
            'cardId' => $this->id,
            'event' => $event,
          ],
          'pId' => $this->getPId(),
        ],
      ]);
    }
  }

  /**
   * Event modifiers template
   **/
  public function isListeningTo($event)
  {
    $passive = $this->getEffectPassive();
    if (
      !in_array($event['type'] ?? 'none', array_keys($passive)) &&
      !in_array($event['action'] ?? 'none', array_keys($passive))
    ) {
      return false;
    }

    if ($event['phase'] ?? false) {
      if ($event['pId'] != $this->getPId()) {
        return false;
      }
    }

    return true;
  }

  public function getReactions($event)
  {
    $passive = $this->getEffectPassive();
    $effects = [];
    // manage player events?
    if (empty($passive)) {
      return [null, null];
    }

    if (!isset($passive[$event['type'] ?? 'none']) && !isset($passive[$event['action'] ?? 'none'])) {
      return [null, null];
    }

    $power = $passive[$event['action'] ?? $event['type']];

    // we are on a listener with multiple effects
    if (isset($power['childs'])) {
      $parallelOutput = [];
      // looks like Payment is not used anymore
      foreach ($power['childs'] as $i => $pow) {
        list($payment, $output) = $this->checkReaction($pow, $event);
        if (!is_null($output) && !empty($output)) {
          $parallelOutput[] = $output;
        }
      }
      return [null, ['type' => NODE_PARALLEL, 'childs' => $parallelOutput]];
    } else {
      return $this->checkReaction($power, $event);
    }
    // $n = $power['n'] ?? 'once';
    // switch ($n) {
    //   case 'eachExpedition':
    //     $output = [];
    //     foreach (STORMS as $storm) {
    //       $event['expedition'] = $storm;
    //       if (Conditions::check($power, $this, $event) === false) {
    //         continue;
    //       }
    //       $output[] = $power['output'];
    //     }
    //     if (empty($output)) {
    //       return [null, null];
    //     }
    //     $power['output'] = FT::SEQ(...$output);
    //     break;
    //   case 'once':
    //     // structured : ['Noon'=>['condition' =>, 'output'=>]]
    //     if (Conditions::check($power, $this, $event) === false) {
    //       return [null, null];
    //     }

    //     break;
    // }

    // // put the source as the card triggering itself
    // $power['output']['sourceId'] = $this->id;

    // return [$power['payment'] ?? [], $power['output']];
  }

  protected function checkReaction($power, $event)
  {
    $n = $power['n'] ?? 'once';
    switch ($n) {
      case 'eachExpedition':
        $output = [];
        foreach (STORMS as $storm) {
          $event['expedition'] = $storm;
          if (Conditions::check($power, $this, $event) === false) {
            continue;
          }
          $output[] = $power['output'];
        }
        if (empty($output)) {
          return [null, null];
        }
        $power['output'] = FT::SEQ(...$output);
        break;
      case 'once':
        // structured : ['Noon'=>['condition' =>, 'output'=>]]
        if (Conditions::check($power, $this, $event) === false) {
          return [null, null];
        }

        break;
    }
    // put the source as the card triggering itself
    $power['output']['sourceId'] = $this->id;
    return [$power['payment'] ?? [], $power['output']];
  }

  public function getCost()
  {
    if ($this->getType() == SPELL && Globals::isNextSpellIsFree()) {
      return 0;
    }

    $costReduction = Globals::getCostReduction()[$this->getPId()] ?? [];
    $typeReduction = 0;
    if (isset($costReduction[$this->getType()])) {
      $typeReduction = $costReduction[$this->getType()]['reduction'];
    }
    foreach ($this->getSubtypes() as $subtype) {
      $typeReduction += isset($costReduction[$subtype]) ? $costReduction[$subtype]['reduction'] : 0;
    }

    // TODO: to update in multiplayer
    $minimumCost = Players::getOpponentMinimumCost($this->getPlayer(), $this->getType());
    $dynamicReduction = $this->getDynamicCostReduction();
    $dynSplit = explode(':', $dynamicReduction);
    if (count($dynSplit) > 1) {
      // we need to test if ok, add change dynamic tough to the value of 0
      if (!is_null(Utils::checkAttributeCondition('cost', $dynamicReduction, $this->getPlayer(), $this))) {
        $dynamicReduction = (int) $dynSplit[0];
      } else {
        $dynamicReduction = 0;
      }
    } else {
      if ($dynamicReduction == '') {
        $dynamicReduction = 0;
      } else {
        $dynamicReduction = (int) $dynamicReduction;
      }
    }

    $increaseReserveCost = Players::getIncreaseReserveCost();
    $reduceReserveCost = Players::getReduceReserveCost();
    if ($reduceReserveCost > 0 && $this->getLocation() == RESERVE) {
      $minimumCost = max(1, $minimumCost);
    }


    switch ($this->getLocation()) {
      case HAND:
        return max($minimumCost, $this->getCostHand() - $typeReduction - ($costReduction[ALL]['reduction'] ?? 0)  - (int) $dynamicReduction);
        break;
      case RESERVE:
        return max($minimumCost, $this->getCostReserve() - $typeReduction - ($costReduction[ALL]['reduction'] ?? 0)  - (int) $dynamicReduction + $increaseReserveCost - $reduceReserveCost);
        break;
    }
  }

  public function getBiomes($includeModifiers = false, $increaseBiomesToHighest = false)
  {
    $biomes = [OCEAN => $this->getOcean(), MOUNTAIN => $this->getMountain(), FOREST => $this->getForest()];
    if ($includeModifiers === true) {
      // BOOST
      $boost = $this->countToken(BOOST);
      foreach ($biomes as $type => &$value) {
        $value += $boost;
      }
    }

    if ($increaseBiomesToHighest == true) {
      $max = 0;
      foreach ($biomes as $type => $value) {
        $max = max($max, $value);
      }
      $biomes = [OCEAN => $max, MOUNTAIN => $max, FOREST => $max];
    }
    return $biomes;
  }

  public function getTough()
  {
    // Tough impacts only a card in Storms or landmark
    if (!in_array($this->getLocation(), STORMS) && $this->getLocation() != LANDMARK) {
      return 0;
    }

    $tough = $this->properties['tough'] ?? 0;
    $dynamicTough = $this->getDynamicTough();
    $dynSplit = explode(':', $dynamicTough);
    if (count($dynSplit) > 1) {
      // we need to test if ok, add change dynamic tough to the value of 0
      if (!is_null(Utils::checkAttributeCondition('tough', $dynamicTough, $this->getPlayer(), $this))) {
        $dynamicTough = $dynSplit[0];
      }
    }
    switch ($dynamicTough) {
      case '':
        // no dynamic
        break;
      case 'region':
        if (Globals::isTieBreakerMode()) {
          break;
        }
        $diff = $this->getPlayer()->getRegionDifference() - 1;
        if ($diff >= 1) {
          $tough += $diff;
        }
        break;
      case 'controlledPlants':
        foreach ($this->getPlayer()->getPlayedCards() as $cId => $card) {
          if (in_array(PLANT, $card->getSubtypes())) {
            $tough++;
          }
        }
        break;
      case 'tough1':
        $tough = 1;
        break;
      case 'tough2':
        $tough = 2;
        break;
    }

    if (in_array($this->getType(), [CHARACTER, TOKEN])) {
      if (!$this->getExcludeUniversalTough()) {
        $tough += $this->getPlayer()->countUniversalCharacterTough();
      }
    }
    return $tough;
  }

  public function isGigantic()
  {
    if (($this->properties['gigantic'] ?? false) == true) {
      return true;
    }

    if ($this->isToken() && $this->getPlayer()->countUniversalTokenGigantic() > 0) {
      return true;
    }

    if (in_array($this->getType(), [TOKEN, CHARACTER])) {

      $dynamicGigantic = $this->getDynamicGigantic();
      // throw new \feException($dynamicGigantic);
      $dynSplit = explode(':', $dynamicGigantic);
      if (count($dynSplit) > 1) {
        // we need to test if ok, add change dynamic tough to the value of 0
        if (!is_null(Utils::checkAttributeCondition('gigantic', $dynamicGigantic, $this->getPlayer(), $this))) {
          return $dynSplit[0];
        }
      }

      $characterCount = $this->getPlayer()->countCardsInLocation($this->getLocation(), [TOKEN, CHARACTER]);
      if ($characterCount > 1) {
        return false;
      }
      foreach ($this->getPlayer()->getPlayedCards() as $cId => $card) {
        if ($card->isGiganticOneCharacter()) {
          return true;
        }
      }
    }

    return false;
  }

  public function isOppositeDefender()
  {
    if (($this->properties['oppositeDefender'] ?? false) == true) {
      return true;
    }

    $dynamicBlocking = $this->getDynamicOppositeDefender();
    if ($dynamicBlocking != '') {
      return !is_null(Utils::checkAttributeCondition('oppositeDefender', $dynamicBlocking, $this->getPlayer(), $this));
    }
    return false;
  }

  // public function getDynamicGigantic()
  // {
  //   return Utils::checkAttributeCondition('eternal', ($this->properties['dynamicGigantic'] ?? ''), $this->getPlayer(), $this);
  // }

  public function isBlockingPower()
  {
    $blocking = $this->properties['blockingPower'] ?? false;
    if ($blocking === true) {
      return true;
    }

    $dynamicBlocking = $this->getDynamicBlockingPower();
    if ($dynamicBlocking != '') {
      return !is_null(Utils::checkAttributeCondition('eternal', $dynamicBlocking, $this->getPlayer(), $this));
    }
    return false;
  }


  public function isEternal()
  {
    if (($this->properties['eternal'] ?? false) == true) {
      return true;
    }

    $dynamicEternal = $this->getDynamicEternal();
    if ($dynamicEternal != '') {
      return !is_null(Utils::checkAttributeCondition('eternal', $dynamicEternal, $this->getPlayer(), $this));
    }
    return false;
  }

  public function isDefender()
  {
    if (($this->properties['defender'] ?? false) == true) {
      return true;
    }
    $subType = '';
    $dynamicDefender = $this->getDynamicDefender();
    switch ($dynamicDefender) {
      case '2OtherPlants':
        $subType = PLANT;
        break;
      case '2OtherBureaucrats':
        $subType = BUREAUCRAT;
        break;
      case 'fullDefender':
        return true;
        break;
    }

    if ($subType != '') {
      $c = 0;
      foreach ($this->getPlayer()->getPlayedCards() as $cId => $card) {
        if ($cId == $this->id) {
          continue;
        }

        if (in_array($subType, $card->getSubtypes())) {
          $c++;
        }
      }
      if ($c < 2) {
        return true;
      }
    }

    if ($dynamicDefender != '' && $subType == '') {
      return !is_null(Utils::checkAttributeCondition('defender', $dynamicDefender, $this->getPlayer(), $this));
    }


    // OD_Common_GulrangTocsin
    if (
      in_array(
        $this->getPlayer()
          ->getHero()
          ->getUid(),
        ['ALT_CORE_B_OR_03_C']
      ) &&
      $this->getPlayer()->getTotalMana() < 8
    ) {
      return $this->isToken() && $this->hasToken(BOOST);
    }
    return false;
  }
}
