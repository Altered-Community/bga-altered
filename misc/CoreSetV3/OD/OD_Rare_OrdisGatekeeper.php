<?php
namespace ALT\Cards\OD;

class OD_Rare_OrdisGatekeeper extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_13_R1',
      'asset' => 'ALT_CORE_B_OR_13_R1',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => 'Ordis Gatekeeper',
      'typeline' => 'Character - Soldier',
      'type' => CHARACTER,
      'flavorText' =>
        'The Aegis Sentinel opened the door and stepped aside to let her through, acknowledging her with a nod as she passed.',
      'artist' => 'Atanas Lozanski',
      'subtypes' => [SOLDIER],
      'effectDesc' => '{J} Create an [ORDIS_RECRUIT] Soldier token in #each of your# Expeditions.',
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 3,
      'costReserve' => 3,
      'changedStats' => ['mountain'],
    ];
  }
}
