<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Rare_ALTNurture extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '126',
      'asset' => 'MU-27-Nurturing-Watering-Can-R',

      'frameSize' => 1,

      'faction' => FACTION_MU,
      'name' => clienttranslate('ALT Nurture'),
      'typeline' => clienttranslate('Rare'),
      'rarity' => RARITY_RARE,
      'type' => SPELL,
      'subtype' => '',

      'effectDesc' => clienttranslate('Up to two target Characters gain <2> boosts.'),
      'reminders' => clienttranslate('(Boosts are +1/+1/+1 counters that are removed when they leave the Expedition Zone.)'),
      'changedStats' => ['costHand', 'costMemory'],
      'costHand' => 3,
      'costMemory' => 2,
      'effectPlayed' => FT::SEQ(
        FT::GAIN($this, FLEETING),
        FT::ACTION(TARGET, ['upTo' => true, 'n' => 2, 'effect' => FT::ACTION(GAIN, ['type' => BOOST, 'n' => 2])])
      ),
    ];
  }
}
