<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_MothCollision extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_YZ_75_R1',
      'asset'  => 'ALT_CYCLONE_B_YZ_75_R',

      'faction'  => FACTION_YZ,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Moth Collision"),
      'typeline' => clienttranslate("Spell - Disruption"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('When two moths meet, there\'s always a spark.'),
      'artist' => "Ed Chee, S.Yong & Stephen",
      'extension' => 'SO',
      'subtypes'  => [DISRUPTION],
      'effectDesc' => clienttranslate('<FLEETING>.  If you control an Illusion, I cost #{2} less.#  Discard target Character #with Hand Cost {3} or less.#'),
      'costHand' => 4,
      'costReserve' => 4,
      'effectPlayed' => FT::SEQ(
        FT::GAIN(ME, FLEETING),
        FT::ACTION(TARGET, ['maxHandCost' => 3, 'effect' => FT::ACTION(DISCARD, [])]),
      ),
      'dynamicCostReduction' => '2:hasControl:illusion:1'
    ];
  }
}
