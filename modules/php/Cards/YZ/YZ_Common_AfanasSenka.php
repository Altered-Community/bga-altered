<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Common_AfanasSenka extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_03_C',
      'asset' => 'ALT_CORE_B_YZ_03_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Afanas & Senka'),
      'typeline' => clienttranslate('Yzmir Hero'),
      'type' => HERO,
      'thumbnail' => 2,
      'statData' => 16,
      'flavorText' => clienttranslate('The world feeds on magic, and withers in its absence.'),
      'artist' => 'Edward Cheekokseang',
      'effectDesc' => clienttranslate(
        'When you play a Spell — Target Character you control gains 1 boost$<BB>. (Do this after the spell resolves.)'
      ),

      'reserveSlots' => 2,
      'landmarkSlots' => 2,

      'effectPassive' => [
        'ChooseAssignment' => [
          'condition' => 'isCardPlayed:spell',
          'output' => FT::ACTION(TARGET, [
            'targetPlayer' => ME,
            'targetType' => [CHARACTER, TOKEN],
            'effect' => FT::GAIN(EFFECT, BOOST),
          ]),
        ],
      ],
    ];
  }
}
