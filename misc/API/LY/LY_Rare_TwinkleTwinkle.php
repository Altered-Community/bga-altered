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
        '[[Fleeting]].  All Characters in target Expedition gain [[Asleep]]. (This only affects one player\'s Characters.) (Send me to Discard instead of Reserve after my effect resolves.Ignore my statistics during Dusk. At Night, I don\'t go to Reserve and I lose Asleep.)'
      ),
      'supportDesc' => clienttranslate(
        '{D} : The next card you play this turn costs {1} less. (Discard me from Reserve to do this.)'
      ),
      'costHand' => 4,
      'costReserve' => 4,
    ];
  }
}
