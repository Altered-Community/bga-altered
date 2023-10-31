<?php
namespace ALT\Cards\OD;

class OD_Common_JeannedArc extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '145',
      'asset' => 'OD-17-JeanneD-Arc-C',
      'frameSize' => 1,

      'faction' => FACTION_OD,
      'name' => clienttranslate("Jeanne d'Arc"),
      'typeline' => clienttranslate('Common - Soldier'),
      'rarity' => RARITY_COMMON,
      'type' => CHARACTER,
      'subtype' => 'Soldier',

      'effectDesc' => clienttranslate(
        'When I leave the Expedition Zone - Create a [1/1/1 Ordis Recruit] Soldier token in both of your Expeditions.'
      ),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 4,
      'costMemory' => 4,
    ];
  }
}
