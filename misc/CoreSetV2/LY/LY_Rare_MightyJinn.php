<?php
namespace ALT\Cards\LY;

class LY_Rare_MightyJinn extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_19_R2',
      'asset' => 'ALT_CORE_B_BR_19_R2',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Mighty Jinn'),
      'typeline' => clienttranslate('Character - Elemental'),
      'type' => CHARACTER,
      'subtypes' => [ELEMENTAL],
      'effectDesc' => clienttranslate(
        'When I leave the Expedition zone — You may put me in my owner\'s Mana zone (as an exhausted Mana Orb).'
      ),
      'forest' => 4,
      'mountain' => 4,
      'ocean' => 0,
      'costHand' => 4,
      'costReserve' => 3,
    ];
  }
}
