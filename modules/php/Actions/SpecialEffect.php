<?php

namespace ALT\Actions;

use ALT\Managers\Meeples;
use ALT\Managers\Players;
use ALT\Managers\Cards;
use ALT\Core\Globals;
use ALT\Core\Stats;
use ALT\Helpers\Utils;
use ALT\Core\Notifications;

class SpecialEffect extends \ALT\Models\Action
{
  public function getState()
  {
    return ST_SPECIAL_EFFECT;
  }

  public function getDescription()
  {
    $effect = $this->getArg('effect');

    if ($effect == 'gainCounter') {
      return [
        'log' => clienttranslate('Gain ${n} ${counter_name}'),
        'args' => [
          'n' => $this->getArg('args')['counter'],
          'counter_name' => $this->getArg('args')['counterName'],
          'i18n' => ['counter_name'],
        ],
      ];
    } elseif ($effect == 'nextCharacterGains1Boost') {
      return clienttranslate('Next character <BOOST>');
    }
    return '';
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
      throw new \BgaVisibleSystemException('no card in args. Should not happen');
    }
    return Cards::get($cardId);
  }

  protected $args = ['effect' => null, 'args' => []];

  public function stSpecialEffect()
  {
    $effect = $this->getArg('effect');
    $args = $this->getArg('args') ?? [];
    $card = $this->getSource();

    switch ($effect) {
      case 'useCard':
        $data = $card->getExtraDatas();
        $data['userPower'] = true;
        $card->setExtraDatas($data);
        break;

      case 'costReduction':
        $reduction = Globals::getCostReduction();
        $reduction[$card->getPId()][$args['type']]['reduction'] = $reduction[$card->getPId()][$args['type']] ?? 0 + $args['reduction'];
        $reduction[$card->getPId()][$args['type']]['permanent'] = ($reduction[$card->getPId()][$args['type']]['permanent'] ?? false) || ($args['permanent'] ?? false);
        Globals::setCostReduction($reduction);
        break;
      case 'gainCounter':
        $data = $card->getExtraDatas();
        $data['counter'] = $args['counter'] ?? 0;
        $data['counterName'] = $args['counterName'] ?? '';
        $card->setExtraDatas($data);

        Notifications::gainCounter($this->getSource());
        break;
      case 'activateAllPermanents':
        $cards = $card->getPlayer()->getPermanents();
        $childs = [];
        foreach ($cards as $cId => $card) {
          $childs[] = ['action' => ACTIVATE_EFFECT, 'optional' => true, 'args' => ['cardId' => $cId], 'sourceId' => $card->getId()];
        }
        $this->pushParallelChilds($childs);
        break;
      case 'nextCharacterGains1Boost':
        Globals::incNextCharacterBoost(1);
        break;
      default:
        break;
    }

    $this->resolveAction([]);
  }
}
