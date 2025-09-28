<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Common_KaurisIntervention extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_MU_75_C',
      'asset'  => 'ALT_CYCLONE_B_MU_75_C',

      'faction'  => FACTION_MU,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Kauri's Intervention"),
      'typeline' => clienttranslate("Spell - Maneuver"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('"This senseless hunt must stop!"'),
      'artist' => "Zero Wen",
      'extension' => 'SO',
      'subtypes'  => [MANEUVER],
      'effectDesc' => clienttranslate('$<FLEETING>.  This Day, Characters with Hand Cost {4} or more you control are <TOUGH_CHA_P_5>. (Opponents must pay {5} to target them.)'),
      'costHand' => 1,
      'costReserve' => 1,
      'effectPlayed' => FT::SEQ(
        FT::GAIN(ME, FLEETING),
        FT::ACTION(SPECIAL_EFFECT, ['effect' => 'globalTough', 'args' => ['type' => CHARACTER, 'minHandCost' => 4, 'tough' => 5]])
      )
    ];
  }
}
