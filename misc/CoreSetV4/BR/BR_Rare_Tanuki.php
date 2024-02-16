<?php
namespace ALT\Cards\BR;

class BR_Rare_Tanuki extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_09_R2',
      'asset' => 'ALT_CORE_B_LY_09_R1',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => 'Tanuki',
      'typeline' => 'Character - Spirit',
      'type' => CHARACTER,
      'flavorText' => '"Pom! Pompoko, pom!"',
      'artist' => 'Matteo Spirito',
      'subtypes' => [SPIRIT],
      'effectDesc' => '{H} $<SABOTAGE>.',
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 0,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
