<?php
namespace ALT\Models;
use ALT\Core\Stats;
use ALT\Core\Notifications;
use ALT\Core\Preferences;
use ALT\Managers\Actions;
use ALT\Managers\Cards;
use ALT\Managers\Meeples;
use ALT\Core\Globals;
use ALT\Core\Engine;
use ALT\Helpers\Utils;

/*
 * Player: all utility functions concerning a player
 */

class Player extends \ALT\Helpers\DB_Model
{
  private $map = null;
  protected $table = 'player';
  protected $primary = 'player_id';
  protected $attributes = [
    'id' => ['player_id', 'int'],
    'no' => ['player_no', 'int'],
    'name' => 'player_name',
    'color' => 'player_color',
    'eliminated' => 'player_eliminated',
    'score' => ['player_score', 'int'],
    'scoreAux' => ['player_score_aux', 'int'],
    'zombie' => 'player_zombie',

    // 'money' => ['money', 'int'],
    // 'reputation' => ['reputation', 'int'],
    // 'appeal' => ['appeal', 'int'],
    // 'conservation' => ['conservation', 'int'],
    // 'xToken' => ['xtoken', 'int'],
    // 'mapId' => 'map_id',
  ];

  public function getUiData($currentPlayerId = null)
  {
    $data = parent::getUiData();
    $current = $this->id == $currentPlayerId;
    // $data['hand'] = $current ? $this->getHand()->ui() : [];
    // $data['handCount'] = $this->getHand()->count();
    // $data['scoringHand'] =
    //     $current || Globals::isEnd() ? $this->getScoringHand()->ui() : [];
    // $data['scoringHandCount'] = $this->getScoringHand()->count();
    // $data['actionCards'] = $this->getActionCards()->ui();
    // $data['icons'] = $this->countCardIcons();
    // $data['income'] = $this->getMoneyIncome();
    // $data['newScore'] = $this->getNewScore();

    // $data['xtoken'] = $this->getXToken();
    // unset($data['xToken']);

    return $data;
  }

  public function getPref($prefId)
  {
    return Preferences::get($this->id, $prefId);
  }

  public function getStat($name)
  {
    $name = 'get' . \ucfirst($name);
    return Stats::$name($this->id);
  }

  public function canTakeAction($action, $ctx)
  {
    return Actions::isDoable($action, $ctx, $this);
  }

  ////////////////////////////////////////
  //  ____       _   _
  // / ___|  ___| |_| |_ ___ _ __ ___
  // \___ \ / _ \ __| __/ _ \ '__/ __|
  //  ___) |  __/ |_| ||  __/ |  \__ \
  // |____/ \___|\__|\__\___|_|  |___/
  ////////////////////////////////////////

  public function pay($n, $notif = true, $source = null)
  {
    if ($this->money < $n) {
      throw new \BgaVisibleSystemException('You don\'t have enough money to pay. Should not happen');
    }

    parent::incMoney(-$n);
    if ($notif) {
      Notifications::payMoney($this, $n, $this->money, $source);
    }

    return $this->money;
  }

  ///////////////////////////////////////////////////
  //  _____              ____              _
  // |__  /___   ___    / ___|__ _ _ __ __| |___
  //   / // _ \ / _ \  | |   / _` | '__/ _` / __|
  //  / /| (_) | (_) | | |__| (_| | | | (_| \__ \
  // /____\___/ \___/   \____\__,_|_|  \__,_|___/
  ///////////////////////////////////////////////////
  public function getHand($type = null)
  {
    return Cards::getHand($this->id)->filter(function ($card) use ($type) {
      return is_null($type) || $card->getType() == $type;
    });
  }

  public function getPlayedCards($type = null)
  {
    return Cards::getPlayedCards($this->id, $type);
  }

  public function hasPlayedCard($id)
  {
    return Cards::hasPlayedCard($this->id, $id);
  }
}
