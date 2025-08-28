<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_MunaSignet extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_MU_79_R1',
      'asset'  => 'ALT_CYCLONE_B_MU_79_R',

      'faction'  => FACTION_MU,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Muna Signet"),
      'typeline' => clienttranslate("Spell - Conjuration"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('Harmony and sharing.'),
      'artist' => "Justice Wong",
      'extension' => 'SO',
      'subtypes'  => [CONJURATION],
      'effectDesc' => clienttranslate('#<FLEETING>.#  Choose #two:#  • Target three Expeditions and create a <WOOLLYBACK> Animal token in each one.  • Target Character with Hand Cost {3} or less gains <ANCHORED>.  • Place a {V} Terrain Marker on target visible region. (It is {V} and loses its other terrains until the Marker is removed.)'),
      'costHand' => 3,
      'costReserve' => 3,
      'changedStats' => ['costHand', 'costReserve'],
      'effectPlayed' => FT::SEQ(
        FT::GAIN(ME, FLEETING),
        [
          'type' => NODE_OR,
          'args' => ['n' => 2, 'canReuse' => true],
          'pId' => 'source',
          'childs' => [
            FT::ACTION(TARGET_EXPEDITION, [
              'n' => 3,
              'effect' =>  FT::ACTION(INVOKE_TOKEN, [
                'pId' => 'source',
                'tokenType' => 'MU_Common_Woollyback',
              ]),
            ]),
            FT::ACTION(TARGET, ['maxHandCost' => 3, 'effect' => FT::GAIN($this, ANCHORED)]),
            FT::ACTION(MARK_REGION, ['create' => true, 'regionType' => FOREST],)
          ]
        ]
      )
    ];
  }
}
