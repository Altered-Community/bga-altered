<?php
namespace ALT\Cards\LY;

class LY_Common_Hathor extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '69',
      'asset' => 'LY-15_Hathor_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_LY,
      'name' => clienttranslate('Hathor'),
      'type' => CHARACTER,
      'subtype' => 'Divinity',
      'typeline' => 'Common - Divinity',
      'rarity' => RARITY_COMMON,

      'echoDesc' => clienttranslate(
        '{D} : Return another card from your Reserve to your hand. (Discard me from your Reserve to activate this effect)'
      ),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 0,
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}
