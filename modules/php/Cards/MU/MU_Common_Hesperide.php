<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Common_Hesperide extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_MU_93_C',
      'asset'  => 'ALT_DUSTER_B_MU_93_C',

      'faction'  => FACTION_MU,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Hesperide"),
      'typeline' => clienttranslate("Character - Fairy"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"No matter what they say, the Naos is suffering, just like the Nilam before it!"'),
      'artist' => "Zael",
      'extension' => 'SDU',
      'subtypes'  => [FAIRY],
      'effectDesc' => clienttranslate('{H} You may pay {2} to return target Permanent to its owner\'s hand.'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
      'effectHand' => FT::SEQ_OPTIONAL(
        FT::ACTION(PAY, ['pay' => 2]),
        FT::ACTION(TARGET, [
          'targetType' => [PERMANENT],
          'targetLocation' => [STORM_LEFT, STORM_RIGHT, LANDMARK],
          'effect' => FT::RETURN_TO_HAND()
        ])
      )
    ];
  }
}
