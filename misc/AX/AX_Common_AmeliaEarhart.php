<?php
namespace ALT\Cards\AX;

class AX_Common_AmeliaEarhart extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '9',
      'asset' => 'AX-17_AmeliaEarhart_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_AX,
      'name' => clienttranslate('Amelia Earhart'),
      'type' => CHARACTER,
      'subtype' => 'Pilot',
      'typeline' => 'Common - Pilot',
      'rarity' => RARITY_COMMON,

      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costMemory' => 3,
    ];
  }
}
