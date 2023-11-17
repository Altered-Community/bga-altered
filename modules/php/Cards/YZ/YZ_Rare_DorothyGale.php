<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_DorothyGale extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '193',
      'asset' => 'YZ-16-DorotyGale-R',
      'frameSize' => 1,

      'faction' => FACTION_YZ,
      'name' => clienttranslate('Dorothy Gale'),
      'typeline' => clienttranslate('Rare - Citizen'),
      'rarity' => RARITY_RARE,
      'type' => CHARACTER,
      'subtype' => 'Citizen',

      'effectDesc' => clienttranslate('[G]{J}[/G] Send to Reserve target Character.'),
      'changedStats' => ['costReserve'],
      'forest' => 3,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 5,
      'costReserve' => 5,
      'effectPlayed' => FT::ACTION(TARGET, ['effect' => FT::DISCARD_TO_RESERVE()]),
    ];
  }
}
