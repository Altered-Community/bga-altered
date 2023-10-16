<?php
namespace ALT\Cards\BR;

class BR_Base_Intimidation extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'USA2023_BR_3_1_12',
      'asset' => 'BR-33_TheHighGround_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Intimidation'),
      'type' => SPELL,
      'subtype' => '',
      'typeline' => 'Spell Base - ',
      'rarity' => RARITY_BASE,
      'effectDesc' => clienttranslate(
        '[[Fleeting]].  Return target Character or Permanent of hand cost {4} or less to its owner\'s hand.'
      ),

      'reminders' => clienttranslate('Fleeting: After my effect resolves, banish me.'),
      'costHand' => 2,
      'costMemory' => 2,
      'effectHand' => [[FLEETING => 1], [TARGET_ALL_ALL_1_4 => [[DISCARD_HAND => 1], [DISCARD => ME]]]],
      'effectMemory' => [[FLEETING => 1], [TARGET_ALL_ALL_1_4 => [[DISCARD_HAND => 1], [DISCARD => ME]]]],
    ];
  }
}
