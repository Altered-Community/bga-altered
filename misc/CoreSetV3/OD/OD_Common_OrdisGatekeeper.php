<?php
namespace ALT\Cards\OD;

class OD_Common_OrdisGatekeeper extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_13_C',
      'asset' => 'ALT_CORE_B_OR_13_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Ordis Gatekeeper'),
      'typeline' => clienttranslate('Character - Soldier'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate(
        'The Aegis Sentinel opened the door and stepped aside to let her through, acknowledging her with a nod as she passed.'
      ),
      'artist' => 'Atanas Lozanski',
      'subtypes' => [SOLDIER],
      'effectDesc' => clienttranslate('{J} Create an [ORDIS_RECRUIT] Soldier token in your other Expedition.'),
      'forest' => 1,
      'mountain' => 3,
      'ocean' => 1,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
