<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_RekaScavenger extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_AX_109_C',
      'asset'  => 'ALT_EOLE_B_AX_109_C',

      'faction'  => FACTION_AX,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Reka Scavenger"),
      'typeline' => clienttranslate("Character - Engineer"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate(''),
      'artist' => "Justice Wong",
      'extension' => 'ROC',
      'subtypes'  => [ENGINEER],
      'effectDesc' => clienttranslate('When you pass — If there\'s at most one card in your hand, I gain 1 boost.'),
      'forest' => 2,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 2,
      'effectPassive' => [
        'EndTurn' => [
          'conditions' => ['isMe', 'hasXCardsInHand:1:LTE'],
          'output' => FT::GAIN(ME, BOOST),
        ]
      ]
    ];
  }
}
