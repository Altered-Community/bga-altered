<?php

namespace ALT\Actions;

use ALT\Managers\Meeples;
use ALT\Managers\Players;
use ALT\Managers\Cards;
use ALT\Core\Notifications;
use ALT\Managers\ActionCards;
use ALT\Core\Engine;
use ALT\Core\Globals;
use ALT\Core\Stats;
use ALT\Helpers\FT;
use ALT\Helpers\Utils;
use ALT\Models\Player;

class InvokeToken extends \ALT\Models\Action
{
  public function getState()
  {
    return ST_INVOKE_TOKEN;
  }

  public function getDescription()
  {
    $msg = clienttranslate('Invoke ${tokenName}');
    return [
      'log' => $msg,
      'args' => [
        'tokenName' => $this->getToken()->getName(),
        'location' => implode(', ', $this->getDisplayLocation()),
        'i18n' => ['tokenName', 'location'],
      ],
    ];
  }

  public function argsInvokeToken()
  {
    $player = Players::getActive();

    $tokenType = $this->getCtxArg('tokenType');
    $targetLocations = $this->getCtxArg('targetLocation') ?? STORMS;

    return [
      'token' => $tokenType,
      'tokenType' => $this->getToken()->getName(),
      'n' => $this->getCtxArg('n') ?? 1,
      'canPass' => $this->getCtxArg('optional') ?? false,
      'locations' => $targetLocations,
    ];
  }

  public function getToken()
  {
    $tokenType = $this->getCtxArg('tokenType');
    $infos = explode('_', $tokenType);
    $className = "\\ALT\\Cards\\$infos[0]\\$tokenType";
    return new $className(null);
  }

  public function isAutomatic($player = null)
  {
    return count($this->argsInvokeToken()['locations']) == 1;
  }

  public function isIndependent($player = null)
  {
    return count($this->argsInvokeToken()['locations']) == 1;
  }

  public function getLocationInfos($location)
  {
    $realLocation = $location;
    $strLocation = $location;

    if (in_array($location, ['source', 'oppositeSource'])) {
      $source = $this->getSource();

      // No actual source => is that even possible ??
      if (is_null($source)) {
        $strLocation = $location == 'source' ? clienttranslate('Source') : clienttranslate('Opposite source');
      }
      // Get the source location
      else {
        $srcLoc = $this->getSource()->getLocation();

        // Check event in case of leaving expedition
        $event = $this->getEvent();
        if (!is_null($event) && in_array($event['method'], ['LeaveExpedition', 'LeaveLandmark']) && isset($event['from'])) {
          $srcLoc = $event['from'];
        }

        // Switch if needed
        if ($location == 'oppositeSource') {
          $realLocation = $srcLoc == STORM_LEFT ? STORM_RIGHT : STORM_LEFT;
        } else {
          $realLocation = $srcLoc;
        }

        $strLocation = $realLocation == STORM_LEFT ? clienttranslate('Hero\'s expedition') : clienttranslate('Companion\'s expedition');
      }
    }

    return [$realLocation, $strLocation];
  }

  public function getDisplayLocation()
  {
    $locations = $this->getCtxArg('targetLocation') ?? STORMS;
    $displayLocation = [];
    foreach ($locations as $loc) {
      list($realLocation, $strLocation) = $this->getLocationInfos($loc);
      $displayLocation[] = $strLocation;
    }

    return $displayLocation;
  }

  public function stInvokeToken()
  {
    $args = $this->argsInvokeToken();
    if (count($args['locations']) == 1) {
      $this->actInvokeToken($args['locations'][0], true);
    }
  }

  public function getPlayer()
  {
    $args = $this->getCtxArgs();
    $pId = $args['pId'] ?? Players::getActiveId();
    if ($pId == 'source') {
      $pId = $this->getSource()->getPId();
    }
    return Players::get($pId);
  }

  public function actInvokeToken($location, $auto = false)
  {
    $player = $this->getPlayer();
    $args = $this->argsInvokeToken();

    if (!in_array($location, $args['locations'])) {
      throw new \BgaVisibleSystemException('You cannot invoke in this location. Should not happen');
    }

    list($realLocation, $strLocation) = $this->getLocationInfos($location);
    $location = $realLocation;

    for ($i = 0; $i < ($this->getCtxArg('n') ?? 1); $i++) {
      $card = $this->getToken();
      $card = Cards::singleCreate([
        'player_id' => $player->getId(),
        'location' => $location,
        'nbr' => 1,
        'properties' => $card->getProperties(),
      ]);

      Notifications::invokeToken($player, $card, $this->getSource());

      // should we boost the card
      if (Globals::getNextCharacterBoost() > 0) {
        $this->insertAsChild(FT::GAIN($card, BOOST, Globals::getNextCharacterBoost()));
        Globals::setNextCharacterBoost(0);
      }

      $this->checkAfterListeners($player, [
        'playCard' => true,
        'cardId' => $card->getId(),
        'cardType' => $card->getType(),
        'from' => 'invoke',
      ]);
    }

    $this->resolveAction([$card->getId()]);
  }
}
