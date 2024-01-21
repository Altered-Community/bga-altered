<?php
namespace ALT\Cards\OD;

class OD_Rare_Achilles extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_21_R2',
      'asset' => 'ALT_CORE_B_BR_21_R1',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => 'Achilles',
      'typeline' => 'Character - Soldier',
      'type' => CHARACTER,
      'flavorText' => "\"Many things lie between us—shadowy mountains and sounding sea.\"",
      'artist' => 'Taras Susak',
      'subtypes' => [SOLDIER],
      'effectDesc' => '$[TOUGH_1].',
      'forest' => 5,
      'mountain' => 5,
      'ocean' => 5,
      'costHand' => 5,
      'costReserve' => 5,
    ];
  }
}
