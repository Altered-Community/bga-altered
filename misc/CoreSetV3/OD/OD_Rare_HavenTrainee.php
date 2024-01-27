<?php
namespace ALT\Cards\OD;

class OD_Rare_HavenTrainee extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_09_R2',
      'asset' => 'ALT_CORE_B_BR_09_R1',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => 'Haven Trainee',
      'typeline' => 'Character - Apprentice',
      'type' => CHARACTER,
      'flavorText' => '"All right, lad, show me what you’ve learned."',
      'artist' => 'Atanas Lozanski',
      'subtypes' => [APPRENTICE],
      'effectDesc' => '{R} #Create an [ORDIS_RECRUIT] Soldier token in each of your Expeditions.#',
      'forest' => 3,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 4,
    ];
  }
}
