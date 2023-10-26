<?php
namespace ALT\Cards\LY;

class LY_Rare_ALTOuroborosTrickster extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '94',
      'asset' => 'LY-33_LyraLegerdemain_RGB_02',
      'frameSize' => 1,

      'faction' => FACTION_LY,
      'name' => clienttranslate('ALT Ouroboros Trickster'),
      'type' => CHARACTER,
      'subtype' => 'Artist',
      'typeline' => 'Rare - Artist',
      'rarity' => RARITY_RARE,

      'effectDesc' => clienttranslate(
        '{J} Roll a die. If the result is 4 or more, I gain <3> boosts. Otherwise, I gain 1 boost.'
      ),
      'reminders' => clienttranslate('(Boosts are +1/+1/+1 counters that are removed when they leave the Expedition Zone.)'),
      'forest' => 0,
      'mountain' => 0,
      'ocean' => 0,
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}
