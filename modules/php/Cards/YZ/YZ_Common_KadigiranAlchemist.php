<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Common_KadigiranAlchemist extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_12_C',
      'asset' => 'ALT_CORE_B_YZ_12_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Kadigiran Alchemist'),
      'type' => CHARACTER,
      'subtypes' => [MAGE],
      'effectDesc' => clienttranslate('{H} I gain 2 boosts$[BB].'),
      'typeline' => clienttranslate('Character - Mage'),
      'flavorText' => clienttranslate(
        "Alchemy is not just a matter of turning lead to gold. It's about purifying yourself of imperfections to become your true self."
      ),
      'artist' => 'Edward Cheekokseang',

      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 3,
      'costReserve' => 1,
      'effectHand' => FT::GAIN($this, BOOST, 2),
    ];
  }
}
