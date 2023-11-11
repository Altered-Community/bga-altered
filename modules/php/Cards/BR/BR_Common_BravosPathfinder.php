<?php
namespace ALT\Cards\BR;

class BR_Common_BravosPathfinder extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '41',
      'asset' => 'BR-08-Gretel-C',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Bravos Pathfinder'),
      'typeline' => clienttranslate('Common - Adventurer'),
      'rarity' => RARITY_COMMON,
      'type' => CHARACTER,
      'subtype' => 'Adventurer',

      'forest' => 0,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
