<?php
namespace ALT\Cards\LY;

class LY_Rare_ALTOuroborosTrickster extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '94',
      'asset' => 'LY-06-LyraLegerdemain-R',
      'frameSize' => 1,

      'faction' => FACTION_LY,
      'name' => clienttranslate('ALT Ouroboros Trickster'),
      'typeline' => clienttranslate('Rare - Artist'),
      'rarity' => RARITY_RARE,
      'type' => CHARACTER,
      'subtype' => 'Artist',

      'effectDesc' => clienttranslate(
        '{J} Roll a die. If the result is 4 or more, I gain [G]3[/G] boosts. Otherwise, I gain 1 boost.'
      ),
      'reminders' => clienttranslate('(Boosts are +1/+1/+1 counters that are removed when they leave the Expedition Zone.)'),
      'changedStats' => ['costMemory'],
      'forest' => 0,
      'mountain' => 0,
      'ocean' => 0,
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}
