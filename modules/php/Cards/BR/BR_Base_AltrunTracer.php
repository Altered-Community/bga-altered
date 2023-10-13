<?php
namespace ALT\Cards\BR;

class BR_Base_AltrunTracer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'USA2023_BR_2_1_4',
      'asset' => 'BR-24_AltrunTracer_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Altrun Tracer'),
      'type' => EXPLORER,
      'subtype' => 'Adventurer',
      'typeline' => 'Explorer Base - Adventurer',
      'rarity' => RARITY_BASE,
      'effectDesc' => clienttranslate('{J} I become [[Fleeting]].'),

      'reminders' => clienttranslate('Fleeting: If I would be sent to Reserve, banish me instead.'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 2,
      'costMemory' => 2,
      'effectHand' => [[FLEETING => 1]],
      'effectMemory' => [[FLEETING => 1]],
    ];
  }
}
