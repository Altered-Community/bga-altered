<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_FoundryArmorer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_16_C',
      'asset' => 'ALT_CORE_B_AX_16_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Foundry Armorer'),
      'type' => CHARACTER,
      'subtypes' => [ENGINEER],
      'effectDesc' => clienttranslate('{R} Create a <BRASSBUG> Robot token in target Expedition.'),
      'flavorText' => clienttranslate('No Brassbug would survive in the Tumult without armor.'),
      'typeline' => clienttranslate('Character - Engineer'),
      'artist' => 'Anh Tung',

      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 3,
      'effectReserve' => FT::ACTION(INVOKE_TOKEN, [
        'pId' => 'source',
        'tokenType' => 'AX_Common_Brassbug',
        'targetLocation' => STORMS,
      ]),
    ];
  }
}
