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
    'initialProperties' => ['initial_properties', 'obj'],
    'properties' => ['properties', 'obj'], // will superseed original properties if needed
  ];

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

    'effectPlayed' => 'obj', // Played, no mater from hand or reserve
    'effectHand' => 'obj', // played from hand
    'effectReserve' => 'obj', // played from reserve
    'effectSupport' => 'obj',
    'effectPassive' => 'obj', // [[listener type => action]]: listener type to distinguish
    'effectTap' => 'obj',

    'tapped' => 'bool',
    'gigantic' => 'bool',
    'dynamicGigantic' => 'str',
    'fleeting' => 'bool',
    'seasoned' => 'bool',
    'minManaOrbs' => 'int', //used for cards that cannot be played unless specific amount of total mana
    'defender' => 'bool',
    'dynamicDefender' => 'str',
    'oppositeDefender' => 'bool', // OD_Common_Issitoq
    'eternal' => 'bool',
    'blockingPower' => 'bool',
    'increaseOpponentCardsCost' => 'int',
    'increaseOpponentCharacterCost' => 'int',
    'increaseOpponentSpellCost' => 'int',
    'increaseOpponentPermanentCost' => 'int',
    'sacrificeAndNotFleetingGoToReserve' => 'bool',
    'sacrificeAndFleetingDraw' => 'bool',
    'updateExpeditions' => 'obj', // type = All, region []
    'blockAutomaticAction' => 'obj',


    // Tough management
    'tough' => 'int',
    'dynamicTough' => 'str',
    'addRoll' => 'int',

    'extraDatas' => 'obj',
  ];

  // 'eqType' => ['type' => , ....]
  // 'location' => 'card_location',
  // 'state' => ['card_state', 'int'],
  // 'pId' => ['player_id', 'int'],
  // 'type' => ['type', 'str'], // Token/hero/adventurer/spell
  // 'tapped' => ['tapped', 'bool'],
  // 'costHand' => ['costHand', 'int'],
  // 'costReserve' => ['costReserve', 'int'],
  // 'name' => ['name', 'str'], // obj?
  // 'rarity' => ['rarity', 'int'],
  // 'equinoxId' => ['equinoxId', 'int'],
  // 'mountain' => ['mountain', 'int'],
  // 'forest' => ['forest', 'int'],
  // 'ocean' => ['ocean', 'int'],
  // 'boostEffect' => ['boostEffect', 'obj'], // ['mountain' => X, 'forest' => Y, ...]
  // 'faction' => ['faction', 'str'],
  // 'effectSupport' => ['effectSupport', 'obj'],
  // 'effectHand' => ['effectHand', 'obj'], // played from hand
  // 'effectReserve' => ['effectReserve', 'obj'], // played from reserve
  // 'effectPassive' => ['effectPassive', 'obj'], // [[listener type => action]]: listener type to distinguish
  // 'costModifier' => ['costModifier', 'obj'], // ['hand'=> action check, 'reserve' => action check]
  // 'extraDatas' => ['extra_datas', 'obj'],
  // // attributs persistants
  // 'initialProperties' => ['initial_properties', 'obj'],
  // 'properties' => ['properties', 'obj'], // will superseed original properties if needed

  public function isSupported($players, $options)
  {
    if (Game::get()->getBgaEnvironment() == 'studio') {
      return true;
    }

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
    $cost = $this->getCost();
    $mana = $player->getMana();
    $totalMana = $player->getTotalMana();

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
    $this->checkLeaveExpeditionListener();
    $this->checkLeaveLandmarkListener();
    $this->setLocation('discard');
    $deleted = Meeples::getInLocation('card-' . $this->id);
    Meeples::delete($deleted->getIds());
    return $deleted;
  }

  public function moveToReserve()
  {
    $this->checkLeaveExpeditionListener();
    $this->checkLeaveLandmarkListener();
    $this->setLocation(RESERVE);
    $this->setTapped(false);
    $seasoned = $this->isSeasoned();
    $deleted = Meeples::getInLocation('card-' . $this->id)
      ->filter(function ($m) use ($seasoned) {
        return $seasoned == false || ($seasoned == true && $m->getType() != BOOST);
      })
      ->getIds();
    if (!empty($deleted)) {
      Meeples::delete($deleted);
    }

    return $deleted;
  }

  // deletes Token that must be removed at night
  public function nightCleanup()
  {
    $tokIds = Meeples::getFiltered(null, 'card-' . $this->id, [ASLEEP, ANCHORED])->getIds();
    Meeples::delete($tokIds);
    return $tokIds;
  }

  public function checkLeaveExpeditionListener()
  {
    if (in_array($this->getLocation(), STORMS)) {
      $event = [
        'type' => 'LeaveExpedition',
        'method' => 'LeaveExpedition',
        'boosted' => $this->hasToken(BOOST),
        'fleeting' => $this->hasToken(FLEETING),
        'cardId' => $this->id,
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
  }

  public function checkLeaveLandmarkListener()
  {
    if ($this->getLocation() == LANDMARK) {
      $event = [
        'type' => 'LeaveLandmark',
        'method' => 'LeaveLandmark',
        'boosted' => $this->hasToken(BOOST),
        'cardId' => $this->id,
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
  }

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

  public function setProperty($variable, $value)
  {
    $this->properties[$variable] = $value;
    $this->setProperties($this->properties);
    // self::DB()->update(['extra_datas' => \addslashes(\json_encode($this->properties))], $this->id);
  }

  // /**
  //  * Scores functions
  //  */

  /**
   * Event modifiers template
   **/
  public function isListeningTo($event)
  {
    $passive = $this->getEffectPassive();
    // throw new \feException(print_r($event));
    if (
      !in_array($event['type'] ?? 'none', array_keys($passive)) &&
      !in_array($event['action'] ?? 'none', array_keys($passive))
    ) {
      return false;
    }

    // $power = $passive[$event['action'] ?? $event['type']];
    // $cond = $power['condition'] ?? null;

    // if (!is_null($cond)) {
    //   // throw new \feException(Conditions::$cond($this, $event));
    //   return Conditions::$cond($this, $event);
    // }
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
    $cond = $power['condition'] ?? null;
    $n = $power['n'] ?? 'once';
    switch ($n) {
      case 'eachExpedition':
        $output = [];
        foreach (STORMS as $storm) {
          $event['expedition'] = $storm;
          if (!is_null($cond) && Conditions::$cond($this, $event) === false) {
            continue;
          }
          $output = $power['output'];
        }
        if (empty($output)) {
          return [null, null];
        }
        $power['output'] = FT::SEQ($output);
        break;
      case 'once':
        // structured : ['Noon'=>['condition' =>, 'output'=>]]
        if (!is_null($cond) && Conditions::$cond($this, $event) === false) {
          return [null, null];
        }

        break;
    }

    // put the source as the card triggering itself
    $power['output']['sourceId'] = $this->id;

    return [($power['payment'] ?? []), $power['output']];
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
    $additionalCost = Players::getOpponentAdditionalCost($this->getPlayer(), $this->getType());

    switch ($this->getLocation()) {
      case HAND:
        return ($this->getCostHand() -
          $typeReduction -
          ($costReduction[ALL]['reduction'] ?? 0) + $additionalCost);
        break;
      case RESERVE:
        return ($this->getCostReserve() -
          $typeReduction -
          ($costReduction[ALL]['reduction'] ?? 0) + $additionalCost);
        break;
    }
  }

  public function getBiomes($includeModifiers = false)
  {
    $biomes = [OCEAN => $this->getOcean(), MOUNTAIN => $this->getMountain(), FOREST => $this->getForest()];
    if ($includeModifiers === true) {
      // BOOST
      $boost = $this->countToken(BOOST);
      foreach ($biomes as $type => &$value) {
        $value += $boost;
      }
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
    }

    if (in_array($this->getType(), [CHARACTER, TOKEN])) {
      $tough += 2 * $this->getPlayer()->countUniversalCharacterTough();
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

    // OD_Common_GulrangTocsin
    if (in_array($this->getPlayer()->getHero()->getUid(), ['ALT_CORE_B_OR_03_C']) && $this->getPlayer()->getTotalMana() < 8) {
      return $this->isToken() && $this->hasToken(BOOST);
    }
    return false;
  }

  /********** EFFECTS **********/
  // public function boost($n, $source = null, $notify = false)
  // {
  //   if (!in_array($this->getLocation(), STORMS)) {
  //     throw new \BgaVisibleSystemException('Cannot be boosted, not in an expedition. Should not happen');
  //   }

  //   $tokens = Meeples::create([['type' => BOOST, 'nbr' => $n, 'location' => 'card-' . $this->id]]);
  //   if ($notify === true) {
  //     Notifications::boost($this, $source, $tokens);
  //   }
  //   return $tokens;
  // }
}
