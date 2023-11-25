<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_ALTDorothyGale extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_16_R1',
      'asset' => 'ALT_CORE_B_YZ_16_R1',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('ALT Dorothy Gale'),
      'type' => CHARACTER,
      'subtype' => [CITIZEN],
      'effectDesc' => clienttranslate('#{J}# Send to Reserve target Character.'),
      'forest' => 3,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 5,
      'costReserve' => 5,
      'changedStats' => ['costReserve'],
      'effectPlayed' => FT::ACTION(TARGET, ['effect' => FT::DISCARD_TO_RESERVE()]),
    ];
  }
}
