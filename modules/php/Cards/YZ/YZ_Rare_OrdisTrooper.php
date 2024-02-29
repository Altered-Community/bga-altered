<?php

namespace ALT\Cards\YZ;

class YZ_Rare_OrdisTrooper extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_05_R2',
      'asset' => 'ALT_CORE_B_OR_05_R1',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => 'Ordis Trooper',
      'typeline' => 'Character - Soldier',
      'type' => CHARACTER,
      'flavorText' => '"Chin up and stand tall. You’re shieldbearers of the Aegis now!"',
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
