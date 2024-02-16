<?php
namespace ALT\Cards\BR;

class BR_Rare_BravosBladedancer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_16_R1',
      'asset' => 'ALT_CORE_B_BR_16_R1',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => 'Bravos Bladedancer',
      'typeline' => 'Character - Soldier',
      'type' => CHARACTER,
      'flavorText' => '"It seems Thoth has never seen me duel."',
      'artist' => 'Taras Susak',
      'subtypes' => [SOLDIER],
      'effectDesc' => '$<SEASONED_ME_FS>.  {J} I gain 1 boost.  #{R} If I have 4 boosts or less, I lose <FLEETING_CHAR>.#',
      'forest' => 0,
      'mountain' => 0,
      'ocean' => 0,
      'costHand' => 1,
      'costReserve' => 3,
    ];
  }
}
