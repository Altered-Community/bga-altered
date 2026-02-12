<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Common_MunaBotanist extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_MU_88_C',
      'asset'  => 'ALT_DUSTER_B_MU_88_C',

      'faction'  => FACTION_MU,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Muna Botanist"),
      'typeline' => clienttranslate("Character - Druid"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('If the Juice gives life, then it must take it from somewhere.'),
      'artist' => "Matteo Spirito",
      'extension' => 'SDU',
      'subtypes'  => [DRUID],
      'effectDesc' => clienttranslate('{H} Target opponent <RESUPPLIES>.  {H} You may target another Character with Base Cost {3} or less, it gains <ANCHORED>. (Its Base Cost is its Reserve Cost if it\'s Fleeting, or its Hand Cost if not.)'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 0,
      'costHand' => 2,
      'costReserve' => 2,
      'effectHand' => [
        'type' => NODE_PARALLEL,
        'childs' => [
          FT::ACTION(RESUPPLY, ['player' => 'nextPlayer']),
          FT::ACTION(TARGET, [
            'upTo' => true,
            'excludeSelf' => true,
            'maxBaseCost' => 3,
            'effect' => FT::GAIN(EFFECT, ANCHORED)
          ])
        ]
      ]
    ];
  }
}
