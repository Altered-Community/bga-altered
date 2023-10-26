<?php
namespace ALT\Cards\LY;

class LY_Common_Asmodeus extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '86',
      'asset' => 'LY-21_Asmodeus_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_LY,
      'name' => clienttranslate('Asmodeus'),
      'type' => CHARACTER,
      'subtype' => 'Demon',
      'typeline' => 'Common - Demon',
      'rarity' => RARITY_COMMON,

      'effectDesc' => clienttranslate(
        '{J} Roll a die. If the result is 4 or more, I gain [[Anchored]]. Otherwise, I gain 3 boosts.'
      ),
      'reminders' => clienttranslate(
        '(Anchored: At Night, I don\'t go to Reserve and I lose Anchored. Boosts are +1/+1/+1 counters that are removed when they leave the Expedition Zone.)'
      ),
      'forest' => 5,
      'mountain' => 5,
      'ocean' => 5,
      'costHand' => 6,
      'costMemory' => 6,
    ];
  }
}
