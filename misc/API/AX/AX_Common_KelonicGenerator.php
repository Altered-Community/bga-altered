<?php
namespace ALT\Cards\AX;

class AX_Common_KelonicGenerator extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_27_C',
      'asset' => 'ALT_CORE_B_AX_27_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Kelonic Generator'),
      'typeline' => clienttranslate('Permanent - Landmark'),
      'type' => PERMANENT,
      'subtypes' => [LANDMARK],
      'flavorText' => clienttranslate('\"Suspira\'s mines will soon run dry. Your precious Kelon will run dry.\"'),
      'effectDesc' => clienttranslate('{2}, {T} : Draw a card.'),
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
