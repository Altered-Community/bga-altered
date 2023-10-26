<?php
namespace ALT\Cards\AX;

class AX_Common_TinkerBell extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '5',
      'asset' => 'AX-18_Tinkder_Bell_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_AX,
      'name' => clienttranslate('Tinker Bell'),
      'type' => CHARACTER,
      'subtype' => 'Fairy',
      'typeline' => 'Common - Fairy',
      'rarity' => RARITY_COMMON,

      'forest' => 3,
      'mountain' => 2,
      'ocean' => 0,
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}
