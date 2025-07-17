<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_JumpingFrog extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_BR_66_R1',
      'asset'  => 'ALT_CYCLONE_B_BR_66_R',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Jumping Frog"),
      'typeline' => clienttranslate("Character - Animal"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('Hop to it!'),
      'artist' => "Abigael Giroud",
      'extension' => 'SO',
      'subtypes'  => [ANIMAL],
      'effectDesc' => clienttranslate('When you pass first — #Target Character# gains 1 boost.'),
      'forest' => 0,
      'mountain' => 0,
      'ocean' => 1,
      'costHand' => 1,
      'costReserve' => 1,
      'effectPassive' => [
        'EndTurn' => [
          'conditions' => ['isFirstPassing'],
          'output' => FT::ACTION(TARGET, ['effect' => FT::ACTION(GAIN, ['type' => BOOST])]),
        ]
      ]
    ];
  }
}
