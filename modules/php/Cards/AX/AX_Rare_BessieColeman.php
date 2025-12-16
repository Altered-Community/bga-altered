<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_BessieColeman extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_AX_68_R1',
      'asset'  => 'ALT_CYCLONE_B_AX_68_R',

      'faction'  => FACTION_AX,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Bessie Coleman"),
      'typeline' => clienttranslate("Character - Adventurer"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"I was destined to fly. I was born to fly." - Bessie'),
      'artist' => "DOBA",
      'extension' => 'SO',
      'subtypes'  => [ADVENTURER],
      'effectDesc' => clienttranslate('When you sacrifice a Permanent — If I have #less than 2 boosts,# I gain 1 boost.'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
      'effectPassive' => [
        'Discard' => [
          'conditions' => ['isMe', 'isSacrifice:permanent', 'hasBoost:1:LTE', 'isInStorms'],
          'output' => FT::GAIN(ME, BOOST, 1),
        ],
      ],
    ];
  }
}
