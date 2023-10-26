<?php
namespace ALT\Cards\BR;

class BR_Common_Intimidation extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '61',
      'asset' => 'BR-33_TheHighGround_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Intimidation'),
      'type' => SPELL,
      'subtype' => '',
      'typeline' => 'Common - ',
      'rarity' => RARITY_COMMON,

      'effectDesc' => clienttranslate(
        '[[Fleeting]].  Return target Character or Permanent of hand cost {4} or less to its owner\'s hand.'
      ),
      'reminders' => clienttranslate('(Fleeting: After my effect resolves, banish me.)'),
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}
