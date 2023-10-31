<?php
namespace ALT\Cards\OD;

class OD_Common_Ozma extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '138',
      'asset' => 'OD-11-Ozma-C',
      'frameSize' => 1,

      'faction' => FACTION_OD,
      'name' => clienttranslate('Ozma'),
      'typeline' => clienttranslate('Common - Citizen'),
      'rarity' => RARITY_COMMON,
      'type' => CHARACTER,
      'subtype' => 'Citizen',

      'effectDesc' => clienttranslate('{J} If you control at least 3 other Characters, draw a card.'),
      'forest' => 1,
      'mountain' => 2,
      'ocean' => 1,
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}
