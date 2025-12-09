<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_LeonardodaVinci extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_AX_94_C',
      'asset'  => 'ALT_DUSTER_B_AX_94_C',

      'faction'  => FACTION_AX,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Leonardo da Vinci"),
      'typeline' => clienttranslate("Character - Artist Engineer"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"The noblest pleasure is the joy of understanding." — Leonardo da Vinci'),
      'artist' => "Atanas Lozanski",
      'extension' => 'SDU',
      'subtypes'  => [ARTIST, ENGINEER],
      'effectDesc' => clienttranslate('{R} You may exhaust ({T}) a Permanent you control to $<RESUPPLY_INF>.'),
      'forest' => 2,
      'mountain' => 3,
      'ocean' => 0,
      'costHand' => 2,
      'costReserve' => 2,
      'effectReserve' => FT::SEQ(
        FT::ACTION(TARGET, [
          'upTo' => true,
          'targetType' => [PERMANENT],
          'targetPlayer' => ME,
          'isNotTapped' => true,
          'effect' => FT::SEQ(
            FT::ACTION(EXHAUST, ['cardId' => EFFECT]),
            FT::ACTION(RESUPPLY, []),
          )
        ])
      )
    ];
  }
}
