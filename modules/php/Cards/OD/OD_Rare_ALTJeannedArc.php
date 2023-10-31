<?php
namespace ALT\Cards\OD;

class OD_Rare_ALTJeannedArc extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '158',
      'asset' => 'OD-17-JeanneD-Arc-C',
      'frameSize' => 1,

      'faction' => FACTION_OD,
      'name' => clienttranslate("ALT Jeanne d'Arc"),
      'type' => CHARACTER,
      'subtype' => 'Soldier',
      'typeline' => clienttranslate('Rare - Soldier'),
      'rarity' => RARITY_RARE,

      'effectDesc' => clienttranslate(
        'When I leave the Expedition Zone - Create [G]two[/G] [1/1/1 Ordis Recruit] Soldier tokens in both of your Expeditions.'
      ),
      'changedStats' => ['costHand', 'costMemory'],
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 5,
      'costMemory' => 5,
    ];
  }
}
