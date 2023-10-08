<?php
namespace ALT\Cards\BR;

class BR_Base_AltrunTracer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'asset' => 'BR-24_AltrunTracer_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Altrun Tracer'),
      'type' => EXPLORER,
      'subtype' => 'Adventurer',
      'rarity' => RARITY_BASE,
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 2,
      'costMemory' => 2,
      'effectMemory' => [[FLEETING => 1]],
      'effectHand' => [[FLEETING => 1]],
    ];
  }
}
