<?php
namespace ALT\Cards\LY;

class LY_Common_ACappellaTraining extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_22_C',
      'asset' => 'ALT_CORE_B_LY_22_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('A Cappella Training'),
      'typeline' => clienttranslate('Spell - Song'),
      'type' => SPELL,
      'subtypes' => [SONG],
      'effectDesc' => clienttranslate(
        'Target Character gains [[Fleeting]]. (If it would be sent to Reserve, discard it instead.)'
      ),
      'costHand' => 1,
      'costReserve' => 1,
    ];
  }
}
