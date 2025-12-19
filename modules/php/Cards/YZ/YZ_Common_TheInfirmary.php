<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Common_TheInfirmary extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_YZ_102_C',
      'asset'  => 'ALT_DUSTER_B_YZ_102_C',

      'faction'  => FACTION_YZ,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("The Infirmary"),
      'typeline' => clienttranslate("Landmark Permanent - Site"),
      'type'  => PERMANENT,
      'flavorText'  => clienttranslate('"I told you it was a bad idea to drink all that Sap Cola…"'),
      'artist' => "HuoMiao Studio",
      'extension' => 'SDU',
      'subtypes'  => [SITE, LANDMARK],
      'effectDesc' => clienttranslate('{T}, Exhaust a card in your Reserve: $<AFTER_YOU>.'),
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
      ])
    ];
  }
}
