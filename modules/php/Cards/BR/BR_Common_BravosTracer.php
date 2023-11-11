<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Common_BravosTracer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '39',
      'asset' => 'BR-07-AltrunTracer-C',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Bravos Tracer'),
      'typeline' => clienttranslate('Common - Adventurer'),
      'rarity' => RARITY_COMMON,
      'type' => CHARACTER,
      'subtype' => 'Adventurer',

      'effectDesc' => clienttranslate('{J} I become [[Fleeting]].'),
      'reminders' => clienttranslate('(Fleeting: If I would be sent to Reserve, banish me instead.)'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 2,
      'costReserve' => 2,
      'effectPlayed' => FT::GAIN($this, FLEETING),
    ];
  }
}
