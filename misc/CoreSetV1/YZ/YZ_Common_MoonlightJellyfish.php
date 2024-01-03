<?php

namespace ALT\Cards\YZ;

class YZ_Common_MoonlightJellyfish extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_05_C',
      'asset' => 'ALT_CORE_B_YZ_05_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Moonlight Jellyfish'),
      'type' => CHARACTER,
      'subtype' => LEVIATHAN,
      'effectDesc' => clienttranslate('When I\'m sacrificed, if I\'m not [FLEETING] — Send me to Reserve.'),
      'forest' => 1,
      'mountain' => 0,
      'ocean' => 1,
      'costHand' => 1,
      'costReserve' => 1,
    ];
  }
}
