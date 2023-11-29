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
      'name' => clienttranslate('Twinkle Twinkle'),
      'typeline' => clienttranslate('Spell - Song'),
      'type' => SPELL,
      'subtypes' => [SONG],
      'effectDesc' => clienttranslate(
        'Target Character gains [[Asleep]]. (Ignore my statistics during Dusk. At Night, I don\'t go to Reserve and I lose Asleep.)'
      ),
      'supportDesc' => clienttranslate(
        '{D} : The next card you play this turn costs {1} less. (Discard me from Reserve to do this.)'
      ),
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
