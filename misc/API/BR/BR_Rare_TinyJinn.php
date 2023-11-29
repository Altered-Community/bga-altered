<?php
namespace ALT\Cards\BR;

class BR_Rare_TinyJinn extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_06_R1',
      'asset' => 'ALT_CORE_B_BR_06_R1',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Tiny Jinn'),
      'typeline' => clienttranslate('Character - Elemental'),
      'type' => CHARACTER,
      'subtypes' => [ELEMENTAL],
      'effectDesc' => clienttranslate(
        'When I leave the Expedition zone, if I\'m [[Boosted]] — Put me in my owner\'s Mana zone (as an exhausted Mana Orb).  {S} I gain 1 boost.'
      ),
      'forest' => 0,
      'mountain' => 2,
      'ocean' => 0,
      'costHand' => 1,
      'costReserve' => 1,
    ];
  }
}
