<?php
namespace ALT\Cards\YZ;

class YZ_Common_Alice extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '177',
      'asset' => 'YZ-14_Alice_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_YZ,
      'name' => clienttranslate('Alice'),
      'type' => CHARACTER,
      'subtype' => 'Citizen',
      'typeline' => 'Common - Citizen',
      'rarity' => RARITY_COMMON,

      'echoDesc' => clienttranslate('{D} : [After You]. (Discard me from your Reserve to activate this effect)'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 4,
      'costHand' => 3,
      'costMemory' => 3,
    ];
  }
}
