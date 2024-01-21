<?php
namespace ALT\Cards\LY;

class LY_Common_TwinkleTwinkle extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_23_C',
      'asset' => 'ALT_CORE_B_LY_23_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => 'Twinkle Twinkle',
      'typeline' => 'Spell - Song',
      'type' => SPELL,
      'flavorText' => 'Up above the world so high, like a diamond in the sky.',
      'artist' => 'HuoMiao Studio',
      'subtypes' => [SONG],
      'effectDesc' =>
        'Target Character gains [ASLEEP]. (During Dusk, ignore its statistics. During Rest, it doesn\'t go to Reserve and it loses Asleep.)',
      'supportDesc' => '{D} : The next card you play this turn costs {1} less. (Discard me from Reserve to do this.)',
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
