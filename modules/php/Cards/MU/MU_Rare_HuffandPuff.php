<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_HuffandPuff extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_MU_118_R1',
      'asset'  => 'ALT_EOLE_B_MU_118_R',
      'faction'  => FACTION_MU,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Huff and Puff"),
      'typeline' => clienttranslate("Spell - Disruption"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate(''),
      'artist' => "Kevin Sidharta",
      'extension' => 'ROC',
      'subtypes'  => [DISRUPTION],
      'effectDesc' => clienttranslate('<FLEETING>.  #Choose an Animal you control,# then target another Character with equal or lower {V} and send it to Reserve.'),
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['costHand', 'costReserve'],
      'effectPlayed' => FT::SEQ(
        FT::GAIN(ME, FLEETING),
        FT::ACTION(TARGET, [
          'targetPlayer' => ME,
          'targetType' => [CHARACTER, TOKEN],
          'subType' => ANIMAL,
          'effect' => FT::SEQ(
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
