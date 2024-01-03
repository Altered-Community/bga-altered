<?php
namespace ALT\Cards\OD;

class OD_Rare_OrdisCadets extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_06_R1',
      'asset' => 'ALT_CORE_B_OR_06_R1',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Ordis Cadets'),
      'typeline' => clienttranslate('Character - Apprentice Soldier'),
      'type' => CHARACTER,
      'subtypes' => [APPRENTICE, SOLDIER],
      'effectDesc' => clienttranslate('{J} Create an [Ordis Recruit 1/1/1] Soldier token in your other Expedition.'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
