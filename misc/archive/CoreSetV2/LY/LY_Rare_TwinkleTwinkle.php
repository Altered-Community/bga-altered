<?php
namespace ALT\Cards\LY;

class LY_Rare_TwinkleTwinkle extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_23_R1',
      'asset' => 'ALT_CORE_B_LY_23_R1',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Twinkle Twinkle'),
      'typeline' => clienttranslate('Spell - Song'),
      'type' => SPELL,
      'subtypes' => [SONG],
      'effectDesc' => clienttranslate(
        '#$[FLEETING].#  #All Characters in target Expedition# gain $[ASLEEP]. (This only affects one player\'s Characters.)'
      ),
      'supportDesc' => clienttranslate(
        '{D} : The next card you play this turn costs {1} less. (Discard me from Reserve to do this.)'
      ),
      'costHand' => 4,
      'costReserve' => 4,
      'changedStats' => ['costHand', 'costReserve'],
    ];
  }
}
