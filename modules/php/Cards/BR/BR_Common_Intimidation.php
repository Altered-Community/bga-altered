<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Common_Intimidation extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '61',
      'asset' => 'BR-28-TheHighGround-C',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Intimidation'),
      'typeline' => clienttranslate('Common'),
      'rarity' => RARITY_COMMON,
      'type' => SPELL,
      'subtype' => '',

      'effectDesc' => clienttranslate(
        '[[Fleeting]].  Return target Character or Permanent of hand cost {4} or less to its owner\'s hand.'
      ),
      'reminders' => clienttranslate('(Fleeting: After my effect resolves, banish me.)'),
      'costHand' => 2,
      'costReserve' => 2,
      'effectPlayed' => FT::SEQ(
        FT::GAIN($this, FLEETING),
        FT::ACTION(TARGET, ['maxHandCost' => 4, 'effect' => FT::RETURN_TO_HAND()])
      ),
    ];
  }
}
