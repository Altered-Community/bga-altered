<?php
namespace ALT\Cards\LY;

class LY_Common_Loki extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_21_C',
      'asset' => 'ALT_CORE_B_LY_21_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => 'Loki',
      'typeline' => 'Character - Deity',
      'type' => CHARACTER,
      'flavorText' => 'What did you expect?',
      'artist' => 'Justice Wong',
      'subtypes' => [DEITY],
      'effectDesc' => '{H} Each player discards their hand, then draws three cards.',
      'forest' => 5,
      'mountain' => 5,
      'ocean' => 5,
      'costHand' => 7,
      'costReserve' => 5,
    ];
  }
}
