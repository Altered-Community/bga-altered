<?php
namespace ALT\Models;

use ALT\Managers\Players;
use ALT\Core\Game;
use ALT\Core\Globals;

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
    'type' => ['type', 'str'], // Token/hero/adventurer/spell
    'tapped' => ['tapped', 'bool'],
    'costHand' => ['costHand', 'int'],
    'costMemory' => ['costMemory', 'int'],
    'name' => ['card_name', 'str'], // obj?
    'rarity' => ['rarity', 'int'],
    'equinoxId' => ['equinoxId', 'int'],
    'mountain' => ['mountain', 'int'],
    'forest' => ['forest', 'int'],
    'water' => ['water', 'int'],
    'boostEffect' => ['boostEffect', 'obj'], // ['mountain' => X, 'forest' => Y, ...]
    'faction' => ['faction', 'str'],
    'effectEcho' => ['effectEcho', 'obj'],
    'effectHand' => ['effectHand', 'obj'], // played from hand
    'effectMemory' => ['effectMemory', 'obj'], // played from memory
    'effectPassive' => ['effectPassive', 'obj'], // [[listener type => action]]: listener type to distinguish
    'costModifier' => ['costModifier', 'obj'], // ['hand'=> action check, 'memory' => action check]
    'effectTap' => ['effectTap', 'obj'],
    'extraDatas' => ['extra_datas', 'obj'],
    // attributs persistants
    'initialProperties' => ['initial_properties', 'obj'],
    'properties' => ['properties', 'obj'], // will superseed original properties if needed
  ];

  protected $staticAttributes = [
    // ['prerequisites', 'obj'],
    // ['continents', 'obj'],
  ];

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
    return $this->location == 'stormLeft' ||
      $this->location == 'stormRight' ||
      $this->location == 'memory' ||
      $this->location == 'inPlay';
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
    return $cost <= $mana;
  }

  // Magic getter to test DB Field & properties field
  public function __call($method, $args)
  {
    if (preg_match('/^([gs]et|inc|is)([A-Z])(.*)$/', $method, $match)) {
      // Sanity check : does the name correspond to a declared variable ?
      $name = mb_strtolower($match[2]) . $match[3];
      // TODO put management of properties
      if (\array_key_exists($name, $this->attributes['properties'])) {
        if ($match[1] == 'get') {
          if (count($args) > 0 && is_array($this->attributes['properties'][$name])) {
            // Handle json field
            return $this->attributes['properties'][$name][$args[0]] ?? null;
          } else {
            // Basic getters
            return $this->attributes['properties'][$name];
          }
        } elseif ($match[1] == 'is') {
          // Boolean getter
          return (bool) ($this->attributes['properties'][$name] != 0);
        }
      }
    } else {
      return parent::$method($args);
    }
  }

  // /**
  //  * Scores functions
  //  */

  /**
   * Event modifiers template
   **/
  public function isListeningTo($event)
  {
    return false;
  }

  public function getCost()
  {
    // TODO: manage cost modifiers
    switch ($this->getLocation()) {
      case HAND:
        return $this->getCostHand();
        break;
      case MEMORY:
        return $this->getCostMemory();
        break;
    }
  }
}
