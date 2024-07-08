<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_Kodama extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_09_R2',
      'asset' => 'ALT_CORE_B_MU_09_R',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Kodama'),
      'typeline' => clienttranslate('Character - Spirit Plant'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate('There\'s no greater blessing for a tree than to offer a home for a Kodama.'),
      'artist' => 'Ba Vo',
      'subtypes' => [SPIRIT, PLANT],
      'effectDesc' => clienttranslate('{H} I gain $<ASLEEP>.'),
      'supportDesc' => clienttranslate(
        '#{D} : Target Character with Hand Cost {3} or less gains <ANCHORED>.# (Discard me from Reserve to do this.)'
      ),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 2,
      'costReserve' => 2,
      'effectHand' => FT::GAIN($this, ASLEEP),
      'supportIcon' => 'discard',
      'effectSupport' => FT::ACTION(TARGET, ['maxHandCost' => 3, 'effect' => FT::GAIN($this, ANCHORED)]),
    ];
  }
}
