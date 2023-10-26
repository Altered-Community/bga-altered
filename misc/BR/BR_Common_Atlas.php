<?php
namespace ALT\Cards\BR;

class BR_Common_Atlas extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '55',
      'asset' => 'BR_20_Atlas_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Atlas'),
      'type' => CHARACTER,
      'subtype' => 'Titan',
      'typeline' => 'Common - Titan',
      'rarity' => RARITY_COMMON,

      'effectDesc' => clienttranslate('[Gigantic].'),
      'reminders' => clienttranslate('(Gigantic: I am considered present in both your Expeditions.)'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 5,
      'costMemory' => 5,
    ];
  }
}
