<?php
namespace ALT\Cards\OD;

class OD_Common_OrdisTrooper extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '129',
      'asset' => 'OR-19_AegisCadet_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_OR,
      'name' => clienttranslate('Ordis Trooper'),
      'type' => CHARACTER,
      'subtype' => 'Soldier',
      'typeline' => 'Common - Soldier',
      'rarity' => RARITY_COMMON,

      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 1,
      'costMemory' => 1,
    ];
  }
}
