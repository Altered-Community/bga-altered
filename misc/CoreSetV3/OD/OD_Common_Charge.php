<?php
namespace ALT\Cards\OD;

class OD_Common_Charge extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_23_C',
      'asset' => 'ALT_CORE_B_OR_23_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Charge!'),
      'typeline' => clienttranslate('Spell - Maneuver'),
      'type' => SPELL,
      'flavorText' => clienttranslate(
        'Facing terrible odds and an unfathomably huge Leviathan, the Ordis legion charged nonetheless.'
      ),
      'artist' => 'Zero Wen',
      'subtypes' => [MANEUVER],
      'effectDesc' => clienttranslate(
        '$[FLEETING].  Characters you control gain 1 boost$[BB]. (Cards in Reserve are not controlled.)'
      ),
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
