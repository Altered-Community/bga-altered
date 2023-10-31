<?php
namespace ALT\Cards\BR;

class BR_Common_Atlas extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '55',
      'asset' => 'BR-20-Atlas-C',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Atlas'),
      'typeline' => clienttranslate('Common - Titan'),
      'rarity' => RARITY_COMMON,
      'type' => CHARACTER,
      'subtype' => 'Titan',

      'effectDesc' => clienttranslate('[Gigantic].'),
      'reminders' => clienttranslate('(Gigantic: I am considered present in both your Expeditions.)'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 5,
      'costMemory' => 5,
      'gigantic' => true,
    ];
  }
}
