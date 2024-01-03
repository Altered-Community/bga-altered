<?php
namespace ALT\Cards\OD;

class OD_Rare_Atlas extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_20_R2',
      'asset' => 'ALT_CORE_B_BR_20_R2',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Atlas'),
      'typeline' => clienttranslate('Character - Titan'),
      'type' => CHARACTER,
      'subtypes' => [TITAN],
      'effectDesc' => clienttranslate(
        '[Gigantic]. (I am considered present in each of your Expeditions.)  Tokens you control have [Gigantic].'
      ),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 5,
      'costReserve' => 5,
    ];
  }
}
