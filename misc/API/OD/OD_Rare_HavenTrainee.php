<?php
namespace ALT\Cards\OD;

class OD_Rare_HavenTrainee extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_09_R2',
      'asset' => 'ALT_CORE_B_BR_09_R2',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Haven Trainee'),
      'typeline' => clienttranslate('Character - Apprentice'),
      'type' => CHARACTER,
      'subtypes' => [APPRENTICE],
      'effectDesc' => clienttranslate('{R} Create an [Ordis Recruit 1/1/1] Soldier token in each of your Expeditions.'),
      'forest' => 3,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 4,
    ];
  }
}
