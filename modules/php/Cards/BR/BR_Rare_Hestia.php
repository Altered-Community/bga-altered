<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_Hestia extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_BISE_B_BR_55_R1',
      'asset'  => 'ALT_BISE_B_BR_55_R',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Hestia"),
      'typeline' => clienttranslate("Character - Deity"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('One offering for one serving of stew. House rules.'),
      'artist' => "Nestor Papatriantafyllou",
      'extension' => 'WFTM',
      'subtypes'  => [DEITY],
      'effectDesc' => clienttranslate('#$<SCOUT_2> {2}.#'),
      'supportDesc' => clienttranslate('{I} When you play another Character — You may pay {1} to give it 1 boost.'),
      'supportIcon' => 'infinity',
      'forest' => 4,
      'mountain' => 4,
      'ocean' => 4,
      'costHand' => 4,
      'costReserve' => 4,
      'changedStats' => ['mountain'],
      'scout' => 2,
      'effectInfinity' => [
        'effectPassive' => [
          'ChooseAssignment' => [
            'condition' => 'isCardPlayed:character:::true',
            'output' => FT::SEQ_OPTIONAL_MANUAL(
              FT::ACTION(PAY, ['pay' => 1]),
              FT::GAIN(EFFECT, BOOST)
            )
          ],
        ]
      ]
    ];
  }
}
