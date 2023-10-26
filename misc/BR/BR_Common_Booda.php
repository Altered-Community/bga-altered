<?php
namespace ALT\Cards\BR;

class BR_Common_Booda extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '67',
      'asset' => 'BR_31_booda_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Booda'),
      'type' => CHARACTER,
      'subtype' => 'Token - Cat',
      'typeline' => 'Common - Token - Cat',
      'rarity' => RARITY_COMMON,

      'effectDesc' => clienttranslate(
        '[Token].  (At the beginning of the game, remove me from your deck. When I leave the Expedition Zone � Remove me from the game).'
      ),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
    ];
  }
}
