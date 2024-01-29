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
      'name' => 'Twinkle Twinkle',
      'typeline' => 'Spell - Song',
      'type' => SPELL,
      'flavorText' => 'Up above the world so high, like a diamond in the sky.',
      'artist' => 'HuoMiao Studio',
      'subtypes' => [SONG],
      'effectDesc' =>
        '#$<FLEETING>.#  #All Characters in target Expedition# gain <ASLEEP>. (This only affects one player\'s Characters. During Dusk, ignore their statistics. During Rest, they don\'t go to Reserve and they lose Asleep.)',
      'supportDesc' => '{D} : The next card you play this turn costs {1} less. (Discard me from Reserve to do this.)',
      'costHand' => 4,
      'costReserve' => 4,
      'changedStats' => ['costHand', 'costReserve'],
    ];
  }
}
