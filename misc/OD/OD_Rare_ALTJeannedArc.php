<?php
namespace ALT\Cards\OD;

class OD_Rare_ALTJeannedArc extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '158',
      'asset' => "OR-14_JeanneD'Arc_RGB_02",
      'frameSize' => 1,

      'faction' => FACTION_OR,
      'name' => clienttranslate("ALT Jeanne d'Arc"),
      'type' => CHARACTER,
      'subtype' => 'Soldier',
      'typeline' => 'Rare - Soldier',
      'rarity' => RARITY_RARE,

      'effectDesc' => clienttranslate(
        'When I leave the Expedition Zone�� Create <two> [1/1/1 Ordis Recruit] Soldier tokens in both of your Expeditions.'
      ),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 5,
      'costMemory' => 5,
    ];
  }
}
