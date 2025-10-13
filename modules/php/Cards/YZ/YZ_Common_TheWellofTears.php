<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Common_TheWellofTears extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_YZ_82_C',
      'asset'  => 'ALT_CYCLONE_B_YZ_82_C',

      'faction'  => FACTION_YZ,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("The Well of Tears"),
      'typeline' => clienttranslate("Landmark Permanent - Site"),
      'type'  => PERMANENT,
      'flavorText'  => clienttranslate('A crack in the heart of the Kadigir...'),
      'artist' => "Khoa Viet",
      'extension' => 'SO',
      'subtypes'  => [SITE, LANDMARK],
      'effectDesc' => clienttranslate('When you play a Spell with Base Cost {4} or more — You may give target Character 1 boost. (Reserve Cost if from Reserve, Hand Cost otherwise.)'),
      'costHand' => 2,
      'costReserve' => 2,
      'effectPassive' => [
        'ChooseAssignment' => [
          'conditions' => ['isCardPlayed:spell', 'cardPlayedCostCheck:4', 'isPlayCard'],
          'output' => FT::ACTION(TARGET, [
            'upTo' => true,
            'effect' => FT::GAIN(EFFECT, BOOST),
          ]),
        ],
      ]
    ];
  }
}
