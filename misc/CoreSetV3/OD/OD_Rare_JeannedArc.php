<?php
namespace ALT\Cards\OD;

class OD_Rare_JeannedArc extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_17_R1',
      'asset' => 'ALT_CORE_B_OR_17_R1',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate("Jeanne d'Arc"),
      'typeline' => clienttranslate('Character - Soldier'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate('She\'ll be followed long after she\'s gone.'),
      'artist' => 'Jean-Baptiste Andrier',
      'subtypes' => [SOLDIER],
      'effectDesc' => clienttranslate(
        'When I leave the Expedition zone — Create #two# <ORDIS_RECRUIT> Soldier tokens in each of your Expeditions.'
      ),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 5,
      'costReserve' => 5,
      'changedStats' => ['costHand', 'costReserve'],
    ];
  }
}
