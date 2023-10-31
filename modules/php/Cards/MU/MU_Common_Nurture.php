<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Common_Nurture extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '123',
      'asset' => 'MU-27-Nurturing-Watering-Can-C',
      'frameSize' => 1,

      'faction' => FACTION_MU,
      'name' => clienttranslate('Nurture'),
      'typeline' => clienttranslate('Common'),
      'rarity' => RARITY_COMMON,
      'type' => SPELL,
      'subtype' => '',

      'effectDesc' => clienttranslate('Up to two target Characters gain 1 boost.'),
      'reminders' => clienttranslate('(Boosts are +1/+1/+1 counters that are removed when they leave the Expedition Zone.)'),
      'costHand' => 2,
      'costMemory' => 2,
      'effectPlayed' => FT::ACTION(TARGET, ['upTo' => true, 'n' => 2, 'effect' => FT::ACTION(GAIN, ['type' => BOOST])]),
    ];
  }
}
