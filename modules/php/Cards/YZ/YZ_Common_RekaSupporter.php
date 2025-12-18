<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Common_RekaSupporter extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_YZ_91_C',
      'asset'  => 'ALT_DUSTER_B_YZ_91_C',

      'faction'  => FACTION_YZ,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Reka Supporter"),
      'typeline' => clienttranslate("Character - Citizen"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('The energy of the crowd is what drives the greatest victories.'),
      'artist' => "Zero Wen",
      'extension' => 'SDU',
      'subtypes'  => [CITIZEN],
      'effectDesc' => clienttranslate('{H} Create a <MANASEED> token in your Landmarks. (It\'s a Permanent with \"{T}, Sacrifice me: Ready a Mana orb.\")'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 2,
      'effectHand' => FT::ACTION(INVOKE_TOKEN, [
        'pId' => 'source',
        'tokenType' => 'NE_Common_Manaseed',
        'targetLocation' => [LANDMARK],
      ]),
    ];
  }
}
