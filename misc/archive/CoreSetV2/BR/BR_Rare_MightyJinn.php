<?php
namespace ALT\Cards\BR;

class BR_Rare_MightyJinn extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_19_R1',
      'asset' => 'ALT_CORE_B_BR_19_R1',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Mighty Jinn'),
      'typeline' => clienttranslate('Character - Elemental'),
      'type' => CHARACTER,
      'subtypes' => [ELEMENTAL],
      'effectDesc' => clienttranslate(
        'When I leave the Expedition zone — You may put me in my owner\'s Mana zone (as an exhausted Mana Orb). #If you don\'t, draw a card.#'
      ),
      'forest' => 4,
      'mountain' => 4,
      'ocean' => 0,
      'costHand' => 4,
      'costReserve' => 3,
    ];
  }
}
