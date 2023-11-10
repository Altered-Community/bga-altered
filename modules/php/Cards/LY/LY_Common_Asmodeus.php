<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Common_Asmodeus extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '86',
      'asset' => 'LY-20-Asmodeus-C',
      'frameSize' => 1,

      'faction' => FACTION_LY,
      'name' => clienttranslate('Asmodeus'),
      'typeline' => clienttranslate('Common - Demon'),
      'rarity' => RARITY_COMMON,
      'type' => CHARACTER,
      'subtype' => 'Demon',

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
      'effectPlayed' => FT::ACTION(ROLL_DIE, [
        'effect' => ['1-3' => FT::GAIN(ME, BOOST, 3), '4+' => FT::GAIN(ME, ANCHORED)],
      ]),
    ];
  }
}
