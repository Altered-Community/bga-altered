<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_SolsHunt extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_BR_78_R1',
      'asset'  => 'ALT_CYCLONE_B_BR_78_R',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Sol's Hunt"),
      'typeline' => clienttranslate("Spell - Disruption"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('"I\'ll stop it before it sows death far and wide!" - Sol'),
      'artist' => "Justice Wong",
      'extension' => 'SO',
      'subtypes'  => [DISRUPTION],
      'effectDesc' => clienttranslate('<FLEETING>.  Send target Character to Reserve.  #If you are first player,# you may <RUSH> to <SABOTAGE_INF>. (Rush means playing another card immediately.)'),
      'costHand' => 3,
      'costReserve' => 3,
      'changedStats' => ['costHand', 'costReserve'],
      'effectPlayed' => FT::SEQ(
        FT::GAIN(ME, FLEETING),
        FT::ACTION(TARGET, [
          'effect' => FT::DISCARD_TO_RESERVE()
        ]),
        FT::ACTION(CHECK_CONDITION, [
          'condition' => 'isFirstPlayer',
          'effect' =>
          FT::SEQ_OPTIONAL(
            FT::RUSH(),
            FT::SABOTAGE()
          )
        ])
      )
    ];
  }
}
