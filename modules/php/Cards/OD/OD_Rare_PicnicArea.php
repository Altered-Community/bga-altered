<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_PicnicArea extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_MU_100_R2',
      'asset'  => 'ALT_DUSTER_B_MU_100_R',

      'faction'  => FACTION_OD,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Picnic Area"),
      'typeline' => clienttranslate("Landmark Permanent - Site"),
      'type'  => PERMANENT,
      'flavorText'  => clienttranslate('Just good, casual feasting.'),
      'artist' => "Kevin Sidharta",
      'extension' => 'SDU',
      'subtypes'  => [SITE, LANDMARK],
      'effectDesc' => clienttranslate('{J} Each player #draws a card.#  When you make a <GIFT> — You may exhaust me ({T}) to have target Character gain 1 boost. (A Gift is when on your turn, an opponent draws a card, Resupplies or receives a token.)'),
      'costHand' => 2,
      'costReserve' => 2,
      'effectPlayed' => FT::ACTION(DRAW, []),
      'effectPassive' => [
        'InvokeToken' => [
          'conditions' => ['isMyTurn', 'isAfternoon', 'isNotMeInvoke'],
          'output' => FT::SEQ_OPTIONAL(
            FT::ACTION(TAP, ['cardId' => ME]),
            FT::ACTION(TARGET, ['effect' => FT::GAIN(EFFECT, BOOST)])
          )
        ],
        'Draw' => [
          'conditions' => ['isMyTurn', 'isAfternoon', 'isNotMe'],
          'output' => FT::SEQ_OPTIONAL(
            FT::ACTION(TAP, ['cardId' => ME]),
            FT::ACTION(TARGET, ['effect' => FT::GAIN(EFFECT, BOOST)])
          )
        ],
        'Resupply' => [
          'conditions' => ['isMyTurn', 'isAfternoon', 'isNotMe'],
          'output' => FT::SEQ_OPTIONAL(
            FT::ACTION(TAP, ['cardId' => ME]),
            FT::ACTION(TARGET, ['effect' => FT::GAIN(EFFECT, BOOST)])
          )
        ]
      ]
    ];
  }
}
