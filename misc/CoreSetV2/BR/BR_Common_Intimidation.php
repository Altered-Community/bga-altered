<?php
namespace ALT\Cards\BR;

class BR_Common_Intimidation extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_28_C',
      'asset' => 'ALT_CORE_B_BR_28_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Intimidation'),
      'typeline' => clienttranslate('Spell - Disruption'),
      'type' => SPELL,
      'subtypes' => [DISRUPTION],
      'effectDesc' => clienttranslate(
        '$[FLEETING].  Return target Character or Permanent with Hand Cost {4} or less to its owner\'s hand.'
      ),
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
