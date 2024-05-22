<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;


class MU_Rare_KelonElemental extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_04_R2',
      'asset' => 'ALT_CORE_B_AX_04_R1',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => 'Kelon Elemental',
      'typeline' => 'Character - Elemental',
      'type' => CHARACTER,
      'flavorText' => 'In true Axiom fashion, Kelon Elementals like to put everything to the taste.',
      'artist' => 'Zero Wen',
      'subtypes' => [ELEMENTAL],
      'effectDesc' => '{H} #You may# put a card from your hand in Reserve.',
      'forest' => 1,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 2,
      'costReserve' => 2,
      'effectHand' => FT::ACTION(TARGET, [
        'targetType' => [CHARACTER, SPELL, PERMANENT],
        'targetPlayer' => ME,
        'upTo' => true,
        'targetLocation' => [HAND],
        'effect' => FT::DISCARD_TO_RESERVE(),
      ], ['optional' => true]),
    ];
  }
}
