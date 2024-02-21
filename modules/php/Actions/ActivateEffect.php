<?php

namespace ALT\Actions;

use ALT\Managers\Meeples;
use ALT\Managers\Players;
use ALT\Managers\Cards;
use ALT\Core\Globals;
use ALT\Core\Stats;
use ALT\Helpers\Utils;
use ALT\Core\Notifications;

class ActivateEffect extends \ALT\Models\Action
{
  public function getState()
  {
    return ST_ACTIVATE_EFFECT;
  }

  public function getDescription()
  {
    if (is_null($this->getCtxArgs()['cardId'] ?? null)) {
      return clienttranslate('activate {J} effect');
    } else {
      return [
        'log' => clienttranslate('activate {J} effect of ${card_name}'),
        'args' => ['card_name' => $this->getCard()->getName(), 'i18n' => ['card_name']],
      ];
    }
  }

  public function isAutomatic($player = null)
  {
    return true;
  }

  public function isIndependent($player = null)
  {
    return true;
  }

  public function getCard()
  {
    $args = $this->getCtxArgs();
    $cardId = $args['cardId'] ?? null;
    if ($cardId === null) {
      throw new \BgaVisibleSystemException('no card in args (Activate effect). Should not happen');
    }
    return Cards::get($cardId);
  }

  protected $args = ['effectType' => 'Played'];

  public function stActivateEffect()
  {
    $source = $this->getSource();
    $card = $this->getCard();

    if (($card->getType() == CHARACTER && !Players::hasOpponentBlockingPower($card->getPlayer(), $card->getLocation())) ||
      $card->getType() != CHARACTER
    ) {
      $effect = 'getEffect' . $this->getArg('effectType');
      Notifications::message(clienttranslate('${player_name} activates ${card_name} {J} effect'), [
        'player' => Players::getActive(),
        'card' => $card,
      ]);
      if (!empty($card->$effect())) {
        $node = $card->$effect();
        $node['sourceId'] = $card->getId();
        $this->pushParallelChild($node);
      }
    } else {
      Notifications::message(clienttranslate('Effects are not triggered, due to an effect in the opponent\'s expedition'), []);
    }

    $this->resolveAction([]);
  }
}
