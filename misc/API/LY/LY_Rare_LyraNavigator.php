<?php
namespace ALT\Cards\LY;

class LY_Rare_LyraNavigator extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_12_R1',
      'asset' => 'ALT_CORE_B_LY_12_R1',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Lyra Navigator'),
      'typeline' => clienttranslate('Character - Citizen'),
      'type' => CHARACTER,
      'subtypes' => [CITIZEN],
      'supportDesc' => clienttranslate(
        '{D} : [Resupply]. (Put the top card of your deck in Reserve. Discard me from Reserve to do this.)'
      ),
      'forest' => 0,
      'mountain' => 0,
      'ocean' => 4,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
