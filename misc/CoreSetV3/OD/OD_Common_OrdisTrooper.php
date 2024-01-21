<?php
namespace ALT\Cards\OD;

class OD_Common_OrdisTrooper extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_05_C',
      'asset' => 'ALT_CORE_B_OR_05_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Ordis Trooper'),
      'typeline' => clienttranslate('Character - Soldier'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate("\"Chin up and stand tall. You’re shieldbearers of the Aegis now!\""),
      'artist' => 'Jean-Baptiste Andrier',
      'subtypes' => [SOLDIER],
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 1,
      'costReserve' => 1,
    ];
  }
}
