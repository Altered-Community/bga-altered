<?php
namespace ALT\Cards\OD;

class OD_Common_OrdisRecruit extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_32_C',
      'asset' => 'ALT_CORE_B_OR_32_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Ordis Recruit'),
      'typeline' => clienttranslate('Token - Soldier'),
      'type' => TOKEN,
      'subtypes' => [SOLDIER],
      'effectDesc' => clienttranslate('(If I leave the Expedition Zone, remove me from the game.)'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
    ];
  }
}
