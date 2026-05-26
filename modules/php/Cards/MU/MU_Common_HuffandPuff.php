<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Common_HuffandPuff extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_MU_118_C',
      'asset' => 'ALT_EOLE_B_MU_118_C',
      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate("Huff and Puff"),
      'typeline' => clienttranslate("Spell - Disruption"),
      'type' => SPELL,
      'flavorText' => clienttranslate(''),
      'artist' => "Kevin Sidharta",
      'extension' => 'ROC',
      'subtypes' => [DISRUPTION],
      'effectDesc' => clienttranslate('$<FLEETING>.  Target Character you control gains 1 boost. Then, target another Character with equal or lower {V} and send it to Reserve.'),
      'costHand' => 3,
      'costReserve' => 3,
      'effectPlayed' => FT::SEQ(
        FT::GAIN(ME, FLEETING),
        FT::ACTION(TARGET, [
          'targetPlayer' => ME,
          'targetType' => [CHARACTER, TOKEN],
          'effect' => FT::SEQ(
            FT::GAIN(TARGET, BOOST),
            FT::ACTION(TARGET, [
              'targetType' => [CHARACTER, TOKEN],
              'targetPlayer' => ALL,
              'excludePreviousTarget' => true,
              'compareTargetBiome' => ['biome' => FOREST, 'op' => 'lte', 'source' => 'cardId'],
              'effect' => FT::DISCARD_TO_RESERVE()
            ])
          )
        ])
      ),
    ];
  }
}
