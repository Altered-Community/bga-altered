<?php
namespace ALT\Cards\AX;

class AX_Common_AmeliaEarhart extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '9',
      'asset' => 'AX-11-AmeliaEarhart-C',
      'frameSize' => 1,

      'faction' => FACTION_AX,
      'name' => clienttranslate('Amelia Earhart'),
      'typeline' => clienttranslate('Common - Pilot'),
      'rarity' => RARITY_COMMON,
      'type' => CHARACTER,
      'subtype' => 'Pilot',

      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costMemory' => 3,
    ];
  }
}
