<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_JumpingFrog extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_BR_66_C',
      'asset'  => 'ALT_CYCLONE_B_BR_66_C',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Jumping Frog"),
      'typeline' => clienttranslate("Character - Animal"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('Hop to it!'),
      'artist' => "Abigael Giroud",
      'extension' => 'SO',
      'subtypes'  => [ANIMAL],
      'effectDesc' => clienttranslate('When you pass first — I gain 1 boost.'),
      'forest' => 0,
      'mountain' => 0,
      'ocean' => 1,
      'costHand' => 1,
      'costReserve' => 1,
      'effectPassive' => [
        'EndTurn' => [
          'conditions' => ['isFirstPassing'],
          'output' => FT::GAIN(ME, BOOST)
        ]
      ]
    ];
  }
}
