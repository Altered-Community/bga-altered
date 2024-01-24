<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_LyraClothDancer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_14_R2',
      'asset' => 'ALT_CORE_B_LY_14_R1',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Lyra Cloth Dancer'),
      'typeline' => clienttranslate('Character - Artist'),
      'type' => CHARACTER,
      'subtypes' => [ARTIST],
      'effectDesc' => clienttranslate(
        '{H} Up to one target Character gains [FLEETING_CHAR]. (If it would be sent to Reserve, discard it instead.)'
      ),
      'forest' => 0,
      'mountain' => 3,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 2,
      'effectHand' => FT::ACTION(TARGET, ['upTo' => true, 'effect' => FT::GAIN(EFFECT, FLEETING)]),

      'flavorText' => clienttranslate("Hope you're not afraid of heights!"),
      'artist' => 'Fori Y.',
    ];
  }
}
