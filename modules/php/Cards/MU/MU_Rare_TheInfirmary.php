<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_TheInfirmary extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_YZ_102_R2',
      'asset'  => 'ALT_DUSTER_B_YZ_102_R',

      'faction'  => FACTION_MU,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("The Infirmary"),
      'typeline' => clienttranslate("Landmark Permanent - Site"),
      'type'  => PERMANENT,
      'flavorText'  => clienttranslate('"I told you it was a bad idea to drink all that Sap Cola…"'),
      'artist' => "HuoMiao Studio",
      'extension' => 'SDU',
      'subtypes'  => [SITE, LANDMARK],
      'effectDesc' => clienttranslate('#{J} <RESUPPLY>.#  {T}, Exhaust a card in your Reserve: <AFTER_YOU>.'),
      'costHand' => 3,
      'costReserve' => 3,
      'effectTap' => FT::ACTION(TARGET, [
        'targetLocation' => [RESERVE],
        'targetPlayer' => ME,
        'isNotTapped' => true,
        'targetType' => [PERMANENT, SPELL, CHARACTER],
        'effect' => FT::SEQ(
          FT::ACTION(EXHAUST, []),
          FT::ACTION(AFTER_YOU, []),
        )
      ]),
      'effectPlayed' => FT::ACTION(RESUPPLY, [])
    ];
  }
}
