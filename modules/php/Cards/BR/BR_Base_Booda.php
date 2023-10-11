<?php
namespace ALT\Cards\BR;

class BR_Base_Booda extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => 'USA2023_BR_2_1_16',
      'asset' => 'BRext1',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Booda'),
      'type' => EXPLORER,
      'subtype' => 'Token — Cat',
      'typeline' => 'Explorer Base - Token — Cat',
      'rarity' => RARITY_BASE,
      'effectDesc' => clienttranslate(
        'I am a [token].  (At the beginning of the game, remove me from your deck. When I leave the Expedition Zone — Remove me from the game).'
      ),

      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
    ];
  }
}
