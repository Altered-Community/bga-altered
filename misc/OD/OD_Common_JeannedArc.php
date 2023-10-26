<?php
namespace ALT\Cards\OD;

class OD_Common_JeannedArc extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '145',
      'asset' => "OR-14_JeanneD'Arc_RGB_01",
      'frameSize' => 1,

      'faction' => FACTION_OR,
      'name' => clienttranslate("Jeanne d'Arc"),
      'type' => CHARACTER,
      'subtype' => 'Soldier',
      'typeline' => 'Common - Soldier',
      'rarity' => RARITY_COMMON,

      'effectDesc' => clienttranslate(
        'When I leave the Expedition Zone�� Create a [1/1/1 Ordis Recruit] Soldier token in both of your Expeditions.'
      ),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 4,
      'costMemory' => 4,
    ];
  }
}
