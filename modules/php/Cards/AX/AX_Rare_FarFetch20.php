<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_FarFetch20 extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_AX_69_R1',
      'asset'  => 'ALT_CYCLONE_B_AX_69_R',

      'faction'  => FACTION_AX,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("FarFetch 2.0"),
      'typeline' => clienttranslate("Character - Robot"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"I\'m glad I got my hooks into this new version!" - Paju'),
      'artist' => "Zael",
      'extension' => 'SO',
      'subtypes'  => [ROBOT],
      'effectDesc' => clienttranslate('{J} You may sacrifice a Permanent. If you do, target Character switches Expeditions.'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 3,
      'changedStats' => ['mountain', 'ocean', 'costHand', 'costReserve'],
      'effectPlayed' => FT::ACTION(TARGET, [
        'targetPlayer' => ME,
        'targetType' => [PERMANENT],
        'upTo' => true,
        'effect' => FT::SEQ(
          FT::ACTION(DISCARD, ['desc' => 'sacrifice']),
          FT::ACTION(TARGET, ['targetType' => [CHARACTER, TOKEN], 'effect' => FT::ACTION(MOVE_CARD, [])]),
        ),
      ])
    ];
  }
}
