<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_TheWellofTears extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_YZ_82_R2',
      'asset'  => 'ALT_CYCLONE_B_YZ_82_R',

      'faction'  => FACTION_LY,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("The Well of Tears"),
      'typeline' => clienttranslate("Landmark Permanent - Site"),
      'type'  => PERMANENT,
      'flavorText'  => clienttranslate('A crack in the heart of the Kadigir...'),
      'artist' => "Khoa Viet",
      'extension' => 'SO',
      'subtypes'  => [SITE, LANDMARK],
      'effectDesc' => clienttranslate('When you play a #card# with Base Cost {4} or more — You may give target Character 1 boost. (Reserve Cost if from Reserve, Hand Cost otherwise.)'),
      'costHand' => 2,
      'costReserve' => 2,
      'effectPassive' => [
        'ChooseAssignment' => [
          'conditions' => ['cardPlayedCostCheck:4', 'isMe'],
          'output' => FT::ACTION(TARGET, [
            'upTo' => true,
            'effect' => FT::GAIN(EFFECT, BOOST),
          ]),
        ],
      ]
    ];
  }
}
