<?php
namespace ALT\Cards\OD;

class OD_Common_OrdisRecruit extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '162',
      'asset' => 'OR-41_AegisRecruit_RGB_02',
      'frameSize' => 1,

      'faction' => FACTION_OR,
      'name' => clienttranslate('Ordis Recruit'),
      'type' => CHARACTER,
      'subtype' => 'Token - Soldier',
      'typeline' => 'Common - Token - Soldier',
      'rarity' => RARITY_COMMON,

      'effectDesc' => clienttranslate(
        '[Token].  (At the beginning of the game, remove me from your deck. When I leave the Expedition Zone � Remove me from the game).'
      ),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
    ];
  }
}
