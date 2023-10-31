<?php
namespace ALT\Cards\BR;

class BR_Rare_BravosTracer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '65',
      'asset' => 'BR-07-AltrunTracer-R',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Bravos Tracer'),
      'typeline' => clienttranslate('Rare - Adventurer'),
      'rarity' => RARITY_RARE,
      'type' => CHARACTER,
      'subtype' => 'Adventurer',

      'effectDesc' => clienttranslate('{J} [[Fleeting]].'),
      'reminders' => clienttranslate('(Fleeting: If I would be sent to Reserve, banish me instead.)'),
      'changedStats' => ['forest', 'ocean'],
      'forest' => 4,
      'mountain' => 3,
      'ocean' => 4,
      'costHand' => 2,
      'costMemory' => 2,
      'effectPlayed' => FT::GAIN($this, FLEETING),
    ];
  }
}
