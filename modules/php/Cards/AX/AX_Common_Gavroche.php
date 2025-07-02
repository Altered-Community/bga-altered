<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_Gavroche extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_AX_66_C',
      'asset'  => 'ALT_CYCLONE_B_AX_66_C',

      'faction'  => FACTION_AX,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Gavroche"),
      'typeline' => clienttranslate("Character - Citizen"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('He fills his basket and retorts by thumbing his nose.'),
      'artist' => "Anh Tung",
      'extension' => 'SO',
      'subtypes'  => [CITIZEN],
      'effectDesc' => clienttranslate('{R} Create an <AEROLITH> token in your Landmarks. (It\'s a Permanent with \"When I\'m sacrificed — Resupply. {T}, {1}: Sacrifice me.\")'),
      'forest' => 0,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 1,
      'costReserve' => 2,
      'effectReserve' => [
        'action' => INVOKE_TOKEN,
        'automatic' => true,
        'args' => ['tokenType' => 'NE_Common_Aerolith', 'targetLocation' => [LANDMARK]],
      ],
    ];
  }
}
