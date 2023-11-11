<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Common_Charge extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '147',
      'asset' => 'OD-23-Charge-C',
      'frameSize' => 1,

      'faction' => FACTION_OD,
      'name' => clienttranslate('Charge!'),
      'typeline' => clienttranslate('Common'),
      'rarity' => RARITY_COMMON,
      'type' => SPELL,
      'subtype' => '',

      'effectDesc' => clienttranslate('[[Fleeting]].  Your Characters gain 1 boost.'),
      'reminders' => clienttranslate(
        '(Fleeting: After my effect resolves, banish me. Boosts are +1/+1/+1 counters that are removed when they leave the Expedition Zone.)'
      ),
      'costHand' => 2,
      'costReserve' => 2,
      'effectPlayed' => FT::SEQ(
        FT::GAIN($this, FLEETING),
        FT::ACTION(TARGET, ['targetPlayer' => ME, 'n' => INFTY, 'effect' => FT::GAIN($this, BOOST)])
      ),
    ];
  }
}
