<?php
namespace ALT\Cards\BR;

class BR_Rare_TwinkleTwinkle extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_23_R2',
      'asset' => 'ALT_CORE_B_LY_23_R2',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Twinkle Twinkle'),
      'typeline' => clienttranslate('Spell - Song'),
      'type' => SPELL,
      'subtypes' => [SONG],
      'effectDesc' => clienttranslate('Target Character gains $[ASLEEP].'),
      'supportDesc' => clienttranslate(
        '{D} : The next card you play this turn costs {1} less. (Discard me from Reserve to do this.)'
      ),
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
