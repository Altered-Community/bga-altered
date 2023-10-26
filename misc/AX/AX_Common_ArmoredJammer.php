<?php
namespace ALT\Cards\AX;

class AX_Common_ArmoredJammer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '21',
      'asset' => 'AX-07-ArmoredJammer_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_AX,
      'name' => clienttranslate('Armored Jammer'),
      'type' => PERMANENT,
      'subtype' => '',
      'typeline' => '',
      'rarity' => RARITY_COMMON,

      'effectDesc' => clienttranslate('{J} [Sabotage].'),
      'reminders' => clienttranslate('(Sabotage: Banish up to one target card from a Reserve.)'),
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}
