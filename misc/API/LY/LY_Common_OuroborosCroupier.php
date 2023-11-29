<?php
namespace ALT\Cards\LY;

class LY_Common_OuroborosCroupier extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_17_C',
      'asset' => 'ALT_CORE_B_LY_17_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Ouroboros Croupier'),
      'typeline' => clienttranslate('Character - Citizen'),
      'type' => CHARACTER,
      'subtypes' => [CITIZEN],
      'effectDesc' => clienttranslate(
        '{M} Roll a die. On a 4 or more, draw a card. Otherwise, [Resupply]. (Put the top card of your deck in your Reserve.)'
      ),
      'forest' => 0,
      'mountain' => 4,
      'ocean' => 4,
      'costHand' => 4,
      'costReserve' => 4,
    ];
  }
}
