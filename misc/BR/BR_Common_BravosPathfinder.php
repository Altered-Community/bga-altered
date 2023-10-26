<?php
namespace ALT\Cards\BR;

class BR_Common_BravosPathfinder extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '41',
      'asset' => 'BR-07_Gretel_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Bravos Pathfinder'),
      'type' => CHARACTER,
      'subtype' => 'Adventurer',
      'typeline' => 'Common - Adventurer',
      'rarity' => RARITY_COMMON,

      'forest' => 0,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}
