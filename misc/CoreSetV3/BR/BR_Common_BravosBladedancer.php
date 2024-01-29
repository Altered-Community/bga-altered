<?php
namespace ALT\Cards\BR;

class BR_Common_BravosBladedancer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_16_C',
      'asset' => 'ALT_CORE_B_BR_16_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => 'Bravos Bladedancer',
      'typeline' => 'Character - Soldier',
      'type' => CHARACTER,
      'flavorText' => '"It seems Thoth has never seen me duel."',
      'artist' => 'Taras Susak',
      'subtypes' => [SOLDIER],
      'effectDesc' => '$<SEASONED>.  {J} I gain 1 boost.',
      'forest' => 0,
      'mountain' => 0,
      'ocean' => 0,
      'costHand' => 1,
      'costReserve' => 3,
    ];
  }
}
