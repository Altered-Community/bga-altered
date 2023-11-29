<?php
namespace ALT\Cards\MU;

class MU_Rare_Esmeralda extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_11_R2',
      'asset' => 'ALT_CORE_B_LY_11_R2',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Esmeralda'),
      'typeline' => clienttranslate('Character - Artist'),
      'type' => CHARACTER,
      'subtypes' => [ARTIST],
      'effectDesc' => clienttranslate('{M} [Resupply]. (Put the top card of your deck in your Reserve.)'),
      'forest' => 0,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
