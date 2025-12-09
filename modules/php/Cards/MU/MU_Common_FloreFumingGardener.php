<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Common_FloreFumingGardener extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_MU_90_C',
      'asset'  => 'ALT_DUSTER_B_MU_90_C',

      'faction'  => FACTION_MU,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Flore, Fuming Gardener"),
      'typeline' => clienttranslate("Character - Druid"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"The Naos has been drained from intensive use!"'),
      'artist' => "Zael",
      'extension' => 'SDU',
      'subtypes'  => [DRUID],
      'effectDesc' => clienttranslate('{J} You may exhaust ({T}) target Permanent in play or target card in Reserve. (Exhausted cards can\'t be played and have no Support abilities.)'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 0,
      'costHand' => 3,
      'costReserve' => 3,
      'effectPlayed' => FT::XOR(
        FT::ACTION(TARGET, [
          'targetType' => [PERMANENT],
          'upTo' => true,
          'effect' => FT::ACTION(EXHAUST, ['cardId' => EFFECT])
        ]),
        FT::ACTION(TARGET, [
          'targetType' => [PERMANENT, CHARACTER, SPELL],
          'targetLocation' => [RESERVE],
          'upTo' => true,
          'effect' => FT::ACTION(EXHAUST, ['cardId' => EFFECT])
        ])

      )
    ];
  }
}
