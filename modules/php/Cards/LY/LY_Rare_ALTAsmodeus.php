<?php
namespace ALT\Cards\LY;

class LY_Rare_ALTAsmodeus extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '96',
      'asset' => 'LY-20-Asmodeus-R',
      'frameSize' => 1,

      'faction' => FACTION_LY,
      'name' => clienttranslate('ALT Asmodeus'),
      'typeline' => clienttranslate('Rare - Demon'),
      'rarity' => RARITY_RARE,
      'type' => CHARACTER,
      'subtype' => 'Demon',

      'effectDesc' => clienttranslate(
        '{J} Roll a dice, if the result is 4 or more I gain [[Anchored]]. Otherwise, I gain 3 boosts.'
      ),
      'reminders' => clienttranslate(
        '(Anchored: At Night, I don\'t go to Reserve and I lose Anchored. Boosts are +1/+1/+1 counters that are removed when they leave the Expedition Zone.)'
      ),
      'changedStats' => ['forest', 'mountain', 'ocean', 'costHand', 'costMemory'],
      'forest' => 4,
      'mountain' => 4,
      'ocean' => 4,
      'costHand' => 5,
      'costMemory' => 5,
    ];
  }
}
