<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_AxiomPuppeteer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_AX_72_R2',
      'asset'  => 'ALT_CYCLONE_B_AX_72_R',

      'faction'  => FACTION_YZ,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Axiom Puppeteer"),
      'typeline' => clienttranslate("Character - Engineer Robot"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"In rock-paper-scissors, I always win by a knockout."'),
      'artist' => "Anh Tung",
      'extension' => 'SO',
      'subtypes'  => [ENGINEER, ROBOT],
      'effectDesc' => clienttranslate('{H} You may sacrifice a #Character# or Permanent to <SABOTAGE_INF>.'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 0,
      'costHand' => 3,
      'costReserve' => 2,
      'effectHand' =>  FT::ACTION(TARGET, [
        'targetPlayer' => ME,
        'targetType' => [PERMANENT, CHARACTER],
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
      ])
    ];
  }
}
