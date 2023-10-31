<?php
namespace ALT\Cards\YZ;

class YZ_Common_Alice extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '177',
      'asset' => 'YZ-13-Alice-C',
      'frameSize' => 1,

      'faction' => FACTION_YZ,
      'name' => clienttranslate('Alice'),
      'typeline' => clienttranslate('Common - Citizen'),
      'rarity' => RARITY_COMMON,
      'type' => CHARACTER,
      'subtype' => 'Citizen',

      'echoDesc' => clienttranslate('{D} : [After You]. (Discard me from your Reserve to activate this effect)'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 4,
      'costHand' => 3,
      'costMemory' => 3,
    ];
  }
}
