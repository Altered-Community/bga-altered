<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Common_Kali extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_YZ_71_C',
      'asset'  => 'ALT_CYCLONE_B_YZ_71_C',

      'faction'  => FACTION_YZ,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Kali"),
      'typeline' => clienttranslate("Character - Deity"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('Each action requires a sacrifice.'),
      'artist' => "Zero Wen",
      'extension' => 'SO',
      'subtypes'  => [DEITY],
      'effectDesc' => clienttranslate('{H} You may put a Spell from your hand in Reserve. If you don\'t, sacrifice me.'),
      'forest' => 3,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
      'effectHand' => FT::XOR(
        FT::ACTION(
          TARGET,
          [
            'targetLocation' => [HAND],
            'targetPlayer' => ME,
            'targetType' => [SPELL],
            'effect' => FT::DISCARD_TO_RESERVE(),
          ]
        ),
        FT::ACTION(DISCARD, ['cardId' => ME, 'desc' => 'sacrifice']),
      )
    ];
  }
}
