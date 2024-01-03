<?php
namespace ALT\Cards\LY;

class LY_Rare_OuroborosCroupier extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_17_R1',
      'asset' => 'ALT_CORE_B_LY_17_R1',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Ouroboros Croupier'),
      'typeline' => clienttranslate('Character - Citizen'),
      'type' => CHARACTER,
      'subtypes' => [CITIZEN],
      'effectDesc' => clienttranslate(
        '{H} Roll a die. On a 4 or higher, draw a card. Otherwise, [Resupply]. (Put the top card of your deck in Reserve.)'
      ),
      'supportDesc' => clienttranslate(
        '{D} : The next card you play this turn costs {1} less. (Discard me from Reserve to do this.)'
      ),
      'forest' => 0,
      'mountain' => 5,
      'ocean' => 5,
      'costHand' => 4,
      'costReserve' => 4,
    ];
  }
}
