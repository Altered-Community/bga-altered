<?php
namespace ALT\Cards\BR;

class BR_Rare_HavenBouncer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_15_R1',
      'asset' => 'ALT_CORE_B_BR_15_R1',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => 'Haven Bouncer',
      'typeline' => 'Character - Adventurer',
      'type' => CHARACTER,
      'flavorText' => 'Only the bravest can enter Haven.',
      'artist' => 'Edward Cheekokseang',
      'subtypes' => [ADVENTURER],
      'effectDesc' => '{H} $[SABOTAGE].  {R} I gain #2 boosts#.',
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
