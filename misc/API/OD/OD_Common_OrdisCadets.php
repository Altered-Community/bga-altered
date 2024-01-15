<?php
namespace ALT\Cards\OD;

class OD_Common_OrdisCadets extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_06_C',
      'asset' => 'ALT_CORE_B_OR_06_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Ordis Cadets'),
      'typeline' => clienttranslate('Character - Apprentice'),
      'type' => CHARACTER,
      'subtypes' => [APPRENTICE],
      'effectDesc' => clienttranslate('{J} Create an [Ordis Recruit 1/1/1] Soldier token in my Expedition.'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 0,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
