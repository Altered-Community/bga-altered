<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_RekaScavenger extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_AX_109_R1',
      'asset'  => 'ALT_EOLE_B_AX_109_R',

      'faction'  => FACTION_AX,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Reka Scavenger"),
      'typeline' => clienttranslate("Character - Engineer"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate(''),
      'artist' => "Justice Wong",
      'extension' => 'ROC',
      'subtypes'  => [ENGINEER],
      'effectDesc' => clienttranslate('When you pass — If your hand #is empty,# I gain #2 boosts.#'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['forest'],
      'effectPassive' => [
        'EndTurn' => [
          [
            'conditions' => ['isMe', 'isHandEmpty'],
            'output' => FT::GAIN(ME, BOOST, 2),
          ],
        ],
      ],
    ];
  }
}
