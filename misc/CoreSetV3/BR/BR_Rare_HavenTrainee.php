<?php
namespace ALT\Cards\BR;

class BR_Rare_HavenTrainee extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_09_R1',
      'asset' => 'ALT_CORE_B_BR_09_R1',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => 'Haven Trainee',
      'typeline' => 'Character - Apprentice',
      'type' => CHARACTER,
      'flavorText' => '"All right, lad, show me what you’ve learned."',
      'artist' => 'Atanas Lozanski',
      'subtypes' => [APPRENTICE],
      'effectDesc' => '{R} I gain 2 boosts$[BB].',
      'supportDesc' => '#{D} : The next Character you play this turn gains 1 boost.# (Discard me from Reserve to do this.)',
      'forest' => 3,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 4,
    ];
  }
}
