<?php
namespace ALT\Cards\AX;

class AX_Rare_ArmoredJammer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_28_R1',
      'asset' => 'ALT_CORE_B_AX_28_R1',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Armored Jammer'),
      'typeline' => clienttranslate('Permanent - Landmark'),
      'type' => PERMANENT,
      'subtypes' => [LANDMARK],
      'effectDesc' => clienttranslate(
        '{J} [Sabotage].  When I leave your Landmark zone — [Sabotage]. (Discard up to one target card from a Reserve.)'
      ),
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
