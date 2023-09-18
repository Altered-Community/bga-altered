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
  ];

  public function getUiData($currentPlayerId = null)
  {
    $data = parent::getUiData();
    $current = $this->id == $currentPlayerId;
    $data['mana'] = $this->getMana();
    $data['totalMana'] = $this->getTotalMana();
    $data['hand'] = $current ? $this->getHand()->ui() : [];
    $data['handCount'] = $this->getHand()->count();
    $data['biomes'] = $this->getBiomeStrength(STORMS, true);
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

  public function draw($nb, $fromLocation = 'deck', $toLocation = 'hand')
  {
    $cards = Cards::pickForLocation($nb, $fromLocation, $toLocation);
    // TODO: notif
    return $cards;
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
    if (self::getMana() < $n) {
      throw new \BgaVisibleSystemException('You don\'t have enough money to pay. Should not happen');
    }

    $mana = Cards::getFilteredQuery($this->id, MANA)
      ->where('tapped', 0)
      ->get();
    $updated = [];
    $i = 0;
    foreach ($mana as $mId => $card) {
      $card->setTapped(true);
      $updated[] = $card->getId();
      $i++;
      if ($i == $n) {
        break;
      }
    }
    if ($notif) {
      Notifications::payMana($this, $n, $this->getMana(), Cards::getMany($updated)->getIds(), $source);
    }

    return;
  }

  ///////////////////////////////////////////////////
  //    ____              _
  //   / ___|__ _ _ __ __| |___
  //   | |   / _` | '__/ _` / __|
  //   | |__| (_| | | | (_| \__ \
  //   \____\__,_|_|  \__,_|___/
  ///////////////////////////////////////////////////
  public function getHand($type = null)
  {
    return Cards::getHand($this->id)->filter(function ($card) use ($type) {
      return is_null($type) || $card->getType() == $type;
    });
  }

  // public function getManaChoice()
  // {
  //   return Cards::getManaChoice($this->id);
  // }

  public function getPlayedCards($type = null)
  {
    return Cards::getPlayedCards($this->id, $type);
  }

  public function hasPlayedCard($id)
  {
    return Cards::hasPlayedCard($this->id, $id);
  }

  public function getMemoryCards()
  {
    return Cards::getMemoryCards($this->id);
  }

  public function getHero()
  {
    return Cards::getPlayedCards($this->id, HERO);
  }

  public function getPermanents()
  {
    return Cards::getPlayedCards($this->id, PERMANENT);
  }

  public function getMana()
  {
    return $this->getTotalMana() -
      count(
        Cards::getFiltered($this->id, MANA)->filter(function ($card) {
          return $card->isTapped();
        })
      );
  }

  public function getTotalMana()
  {
    return count(Cards::getFiltered($this->id, MANA));
  }

  /************** Expedition calculation *******/
  public function getBiomeStrength($expeditions, $includeModifiers = true)
  {
    $strengths = [];
    $cards = $this->getPlayedCards();

    foreach ($expeditions as $i => $exp) {
      $strength = [OCEAN => 0, MOUNTAIN => 0, FOREST => 0]; // OCEAN/MOUNTAIN/FOREST
      foreach ($cards as $c => $card) {
        if ($card->getLocation() != $exp) {
          continue;
        }

        $biome = $card->getBiomes($includeModifiers);
        foreach ($biome as $bi => $value) {
          $strength[$bi] += $value;
        }
      }
      $strengths[$exp] = $strength;
    }
    return $strengths;
  }
}
