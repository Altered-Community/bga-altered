<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Common_PhysicalTraining extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '58',
      'asset' => 'BR-26-GerichtVanBraast-C',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Physical Training'),
      'typeline' => clienttranslate('Common'),
      'rarity' => RARITY_COMMON,
      'type' => SPELL,
      'subtype' => '',

      'effectDesc' => clienttranslate('Target Character gains 3 boosts.'),
      'reminders' => clienttranslate('(Boosts are +1/+1/+1 counters that are removed when they leave the Expedition Zone.)'),
      'costHand' => 2,
      'costMemory' => 2,
      'effectPlayed' => FT::ACTION(TARGET, ['effect' => FT::ACTION(GAIN, ['type' => BOOST, 'n' => 3])]),
    ];
  }
}
