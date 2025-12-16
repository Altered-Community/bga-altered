<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_BessieColeman extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_AX_68_R2',
      'asset'  => 'ALT_CYCLONE_B_AX_68_R',

      'faction'  => FACTION_YZ,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Bessie Coleman"),
      'typeline' => clienttranslate("Character - Adventurer"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"I was destined to fly. I was born to fly." - Bessie'),
      'artist' => "DOBA",
      'extension' => 'SO',
      'subtypes'  => [ADVENTURER],
      'effectDesc' => clienttranslate('When you sacrifice a #Character# or Permanent — If I have no boosts, I gain 1 boost.'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
      'effectPassive' => [
        'Discard' => [
          'childs' => [
            [
              'conditions' => ['isMe', 'isSacrifice:permanent', 'hasBoost:0:LTE', 'isInStorms'],
              'output' => FT::GAIN(ME, BOOST, 1),
            ],
            [
              'conditions' => ['isMe', 'isSacrifice:character', 'hasBoost:0:LTE', 'isInStorms'],
              'output' => FT::GAIN(ME, BOOST, 1),
            ],
          ],
        ],
      ]
    ];
  }
}
