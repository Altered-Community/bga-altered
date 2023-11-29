<?php
namespace ALT\Cards\LY;

class LY_Rare_LyraClothDancer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_14_R1',
      'asset' => 'ALT_CORE_B_LY_14_R1',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Lyra Cloth-Dancer'),
      'typeline' => clienttranslate('Character - Artist'),
      'type' => CHARACTER,
      'subtypes' => [ARTIST],
      'effectDesc' => clienttranslate(
        '{M} All of target player\'s Characters gain [[Fleeting]]. (If I would be sent to Reserve, discard me instead.)'
      ),
      'forest' => 0,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
