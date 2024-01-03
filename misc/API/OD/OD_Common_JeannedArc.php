<?php
namespace ALT\Cards\OD;

class OD_Common_JeannedArc extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_17_C',
      'asset' => 'ALT_CORE_B_OR_17_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate("Jeanne d'Arc"),
      'typeline' => clienttranslate('Character - Soldier'),
      'type' => CHARACTER,
      'subtypes' => [SOLDIER],
      'effectDesc' => clienttranslate(
        'When I leave the Expedition zone — Create an [Ordis Recruit 1/1/1] Soldier token in each of your Expeditions.'
      ),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 4,
      'costReserve' => 4,
    ];
  }
}
