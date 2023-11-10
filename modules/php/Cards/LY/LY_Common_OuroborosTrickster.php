<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Common_OuroborosTrickster extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '73',
      'asset' => 'LY-06-LyraLegerdemain-C',
      'frameSize' => 1,

      'faction' => FACTION_LY,
      'name' => clienttranslate('Ouroboros Trickster'),
      'typeline' => clienttranslate('Common - Artist'),
      'rarity' => RARITY_COMMON,
      'type' => CHARACTER,
      'subtype' => 'Artist',

      'effectDesc' => clienttranslate('{J} Roll a die. If the result is 4 or more, I gain 2 boosts. Otherwise, I gain 1 boost.'),
      'reminders' => clienttranslate('(Boosts are +1/+1/+1 counters that are removed when they leave the Expedition Zone.)'),
      'forest' => 0,
      'mountain' => 0,
      'ocean' => 0,
      'costHand' => 2,
      'costMemory' => 2,
      'effectPlayed' => FT::ACTION(ROLL_DIE, [
        'effect' => ['1-3' => FT::GAIN(ME, BOOST, 1), '4+' => FT::GAIN(ME, BOOST, 2)],
      ]),
    ];
  }
}
