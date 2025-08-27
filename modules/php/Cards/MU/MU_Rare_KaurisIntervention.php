<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_KaurisIntervention extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_MU_75_R1',
      'asset'  => 'ALT_CYCLONE_B_MU_75_R',

      'faction'  => FACTION_MU,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Kauri's Intervention"),
      'typeline' => clienttranslate("Spell - Maneuver"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('"This senseless hunt must stop!"'),
      'artist' => "Zero Wen",
      'extension' => 'SO',
      'subtypes'  => [MANEUVER],
      'effectDesc' => clienttranslate('#Target a player.# This Day, Characters with Hand Cost #{3} or more that they control# are <TOUGH_CHA_P_5>.'),
      'costHand' => 1,
      'costReserve' => 1,
      'effectPlayed' => FT::SEQ(
        FT::GAIN(ME, FLEETING),
        FT::ACTION(SPECIAL_EFFECT, ['effect' => 'globalTough', 'args' => ['type' => CHARACTER, 'minHandCost' => 3, 'tough' => 5]])
      )
    ];
  }
}
