<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_PastryChef extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_BISE_B_BR_54_R2',
      'asset'  => 'ALT_BISE_B_BR_54_R',

      'faction'  => FACTION_YZ,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Pastry Chef"),
      'typeline' => clienttranslate("Character - Citizen"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('Pioneers in more ways than one, the Bravos were the first to experiment with Sap in the culinary arts.'),
      'artist' => "Nestor Papatriantafyllou",
      'extension' => 'WFTM',
      'subtypes'  => [CITIZEN],
      'effectDesc' => clienttranslate('#$<SEASONED>.#  {R} If I have 2 or more boosts, draw a card.'),
      'supportDesc' => clienttranslate('{I} When you play a #Spell# — I gain 1 boost, up to a #max of 2.#'),
      'supportIcon' => 'infinity',
      'forest' => 2,
      'mountain' => 4,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 4,
      'changedStats' => ['costReserve'],
      'seasoned' => true,
      'effectInfinity' => [
        'effectPassive' => [
          'ChooseAssignment' => [
            'condition' => 'isCardPlayed:spell',
            'output' => FT::GAIN(ME, BOOST, 1, 2),
          ],
        ]
      ],
      'effectReserve' => FT::ACTION(CHECK_CONDITION, [
        'condition' => 'hasBoost:2',
        'description' => clienttranslate('Draw a card if the card has 2+ boosts'),
        'effect' => FT::ACTION(DRAW, ['players' => ME])
      ]),
      'blockAutomaticAction' => [GAIN => [BOOST => 1], CHECK_CONDITION => ['hasBoost:2']],
    ];
  }
}
