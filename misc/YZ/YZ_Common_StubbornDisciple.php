<?php
namespace ALT\Cards\YZ;

class YZ_Common_StubbornDisciple extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '172',
      'asset' => 'YZ-05_SteadfastDisciple_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_YZ,
      'name' => clienttranslate('Stubborn Disciple'),
      'type' => CHARACTER,
      'subtype' => 'Mage',
      'typeline' => 'Common - Mage',
      'rarity' => RARITY_COMMON,

      'echoDesc' => clienttranslate(
        '{D} : The next Spell you play this turn costs {1} less. (Discard me from your Reserve to activate this effect)'
      ),
      'forest' => 0,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 1,
      'costMemory' => 1,
    ];
  }
}
