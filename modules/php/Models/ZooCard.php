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
    'extraDatas' => ['extra_datas', 'obj'],
  ];

  protected $staticAttributes = [
    // ['prerequisites', 'obj'],
    // ['continents', 'obj'],
  ];

  public function getIcons()
  {
    return [];
  }

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
    return $this->jsonSerialize(); // Static datas are already in js file
  }

  public function isPlayed()
  {
    return $this->location == 'inPlay';
  }

  public function getPlayer($checkPlayed = false)
  {
    if (!$this->isPlayed() && $checkPlayed) {
      throw new \feException("Trying to get the player for a non-played card : {$this->id}");
    }

    return Players::get($this->pId);
  }

  public function canBePlayed($player, $icons, $nCanIgnore = 0)
  {
    $status = $this->checkConditions($player, $icons, $nCanIgnore);
    return $status['valid'];
  }

  // /**
  //  * Scores functions
  //  */

  public function score()
  {
    $bonus = $this->getScoreBonus();
    if (!is_null($bonus)) {
      foreach ($bonus as $b => $value) {
        $method = 'inc' . ucfirst($b);
        $this->getPlayer()->$method($value, true, $this);
      }
    }
  }

  public function getScoreBonus()
  {
    return null;
  }

  /**
   * Event modifiers template
   **/
  public function isListeningTo($event)
  {
    return false;
  }
}
