<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_AxiomPuppeteer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_AX_72_R1',
      'asset'  => 'ALT_CYCLONE_B_AX_72_R',

      'faction'  => FACTION_AX,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Axiom Puppeteer"),
      'typeline' => clienttranslate("Character - Engineer Robot"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"In rock-paper-scissors, I always win by a knockout."'),
      'artist' => "Anh Tung",
      'extension' => 'SO',
      'subtypes'  => [ENGINEER, ROBOT],
      'effectDesc' => clienttranslate('{H} You may sacrifice a Permanent to <SABOTAGE_INF>.  #When you sacrifice a Permanent — If I have no boosts, I gain 1 boost.#'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 0,
      'costHand' => 3,
      'costReserve' => 2,
      'effectHand' =>  FT::ACTION(TARGET, [
        'targetPlayer' => ME,
        'targetType' => [PERMANENT],
        'upTo' => true,
        'effect' => FT::SEQ(
          FT::ACTION(DISCARD, ['desc' => 'sacrifice']),
          FT::ACTION(TARGET, [
            'targetType' => [CHARACTER, SPELL, TOKEN, PERMANENT],
            'targetLocation' => [RESERVE],
            'upTo' => true,
            'effect' => FT::ACTION(DISCARD, []),
          ]),
        )
      ]),
      'effectPassive' => [
        'Discard' => [
          'conditions' => ['isMe', 'isSacrifice:permanent', 'hasBoost:0:LTE'],
          'output' => FT::GAIN($this, BOOST, 1),
        ],
      ],
    ];
  }
}
