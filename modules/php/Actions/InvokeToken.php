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
use ALT\Helpers\Collection;
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
    return clienttranslate('Invoke a token');
  }

  public function argsInvokeToken()
  {
    $player = Players::getCurrent();

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

  public function stInvokeToken()
  {
    $args = $this->argsInvokeToken();
    if (count($args['locations']) == 1) {
      $this->actInvokeToken($args['locations'][0], true);
    }
  }

  public function actInvokeToken($location, $auto = false)
  {
    if ($auto === false) {
      self::checkAction('actInvokeToken');
    }
    $player = Players::getActive();
    $args = $this->argsInvokeToken();

    if (!in_array($location, $args['locations'])) {
      throw new \BgaVisibleSystemException('You cannot invoke in this location. Should not happen');
    }

    $card = $this->getToken();
    $card = Cards::singleCreate([
      'player_id' => $player->getId(),
      'location' => $location,
      'nbr' => 1,
      'properties' => $card->getProperties(),
    ]);

    Notifications::invokeToken($player, $card, $this->getSource());
    $this->resolveAction([$card->getId()]);
  }

  public function actTargetPass()
  {
    self::checkAction('actTarget');
    $player = Players::getActive();
    if (($this->getCtxArg('optional') ?? 'toto') !== true) {
      throw new \BgaVisibleSystemException('This action cannot be passed.Should not happen');
    }
    // TODO: how to exclude after nodes
    // TODO: Change intimidation
    $this->resolveAction([PASS]);
  }
}
