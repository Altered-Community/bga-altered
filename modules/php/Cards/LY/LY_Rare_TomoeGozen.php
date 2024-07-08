<?php

namespace ALT\Cards\LY;

class LY_Rare_TomoeGozen extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_23_R2',
      'asset' => 'ALT_CORE_B_BR_23_R',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Tomoe Gozen'),
      'typeline' => clienttranslate('Character - Soldier'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate(
        'For only the most gifted of Alterers could bring humanity\'s long-remembered legends to life.'
      ),
      'artist' => 'Edward Cheekokseang',
      'subtypes' => [SOLDIER],
      'effectDesc' => clienttranslate('I can\'t be played if you have less than #six Mana Orbs#.'),
      'forest' => 2,
      'mountain' => 5,
      'ocean' => 5,
      'costHand' => 3,
      'costReserve' => 3,
      'minManaOrbs' => 6,
    ];
  }
}
