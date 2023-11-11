<?php
namespace ALT\Cards\AX;

class AX_Common_ArmoredJammer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '21',
      'asset' => 'AX-28-ArmoredJammer-C',
      'frameSize' => 1,

      'faction' => FACTION_AX,
      'name' => clienttranslate('Armored Jammer'),
      'typeline' => '',
      'rarity' => RARITY_COMMON,
      'type' => PERMANENT,
      'subtype' => '',

      'effectDesc' => clienttranslate('{J} [Sabotage].'),
      'reminders' => clienttranslate('(Sabotage: Banish up to one target card from a Reserve.)'),
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
