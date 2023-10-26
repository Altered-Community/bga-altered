<?php
namespace ALT\Cards\BR;

class BR_Common_BravosTracer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '39',
      'asset' => 'BR-24_AltrunTracer_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Bravos Tracer'),
      'type' => CHARACTER,
      'subtype' => 'Adventurer',
      'typeline' => 'Common - Adventurer',
      'rarity' => RARITY_COMMON,

      'effectDesc' => clienttranslate('{J} I become [[Fleeting]].'),
      'reminders' => clienttranslate('(Fleeting: If I would be sent to Reserve, banish me instead.)'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}
