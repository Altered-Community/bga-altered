<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_RidetheBifrost extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_28_R2',
      'asset' => 'ALT_CORE_B_LY_28_R',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Ride the Bifröst'),
      'typeline' => clienttranslate('Spell - Maneuver'),
      'type' => SPELL,
      'flavorText' => clienttranslate('The Lyra never play by the rules.'),
      'artist' => 'Fahmi Fauzi',
      'subtypes' => [MANEUVER],
      'effectDesc' => clienttranslate(
        '$<FLEETING>.  All Characters you control switch Expeditions. (They leave their Expeditions and join their controller\'s other Expedition.)'
      ),
      'costHand' => 2,
      'costReserve' => 2,
      'effectPlayed' => FT::SEQ(FT::GAIN(ME, FLEETING), FT::ACTION(MOVE_CARD, ['player' => ME, 'cards' => ALL])),
    ];
  }
}
