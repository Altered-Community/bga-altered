<?php
namespace ALT\Cards\BR;

class BR_Rare_BravosTracer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '65',
      'asset' => 'BR-24_AltrunTracer_RGB_02',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Bravos Tracer'),
      'type' => CHARACTER,
      'subtype' => 'Adventurer',
      'typeline' => 'Rare - Adventurer',
      'rarity' => RARITY_RARE,

      'effectDesc' => clienttranslate('{J} [[Fleeting]].'),
      'reminders' => clienttranslate('(Fleeting: If I would be sent to Reserve, banish me instead.)'),
      'forest' => 4,
      'mountain' => 3,
      'ocean' => 4,
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}
