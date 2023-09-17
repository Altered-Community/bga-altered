<?php
namespace ALT\Cards\BR;

class BR_Rare_SkilledTracer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'asset' => 'BR-24_AltrunTracer_RGB_02',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Skilled Tracer'),
      'type' => EXPLORER,
      'subtype' => 'Adventurer',
      'rarity' => RARITY_RARE,
      'forest' => 4,
      'mountain' => 3,
      'water' => 4,
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}
