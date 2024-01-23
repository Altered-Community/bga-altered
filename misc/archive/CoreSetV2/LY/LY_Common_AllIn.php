<?php
namespace ALT\Cards\LY;

class LY_Common_AllIn extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_25_C',
      'asset' => 'ALT_CORE_B_LY_25_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('All In!'),
      'typeline' => clienttranslate('Spell - Boon'),
      'type' => SPELL,
      'subtypes' => [BOON],
      'effectDesc' => clienttranslate('Roll a die. Target Character gains X boosts$[BB], where X is the result.'),
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
