<?php
namespace ALT\Cards\LY;

class LY_Rare_Martengale extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_04_R1',
      'asset' => 'ALT_CORE_B_LY_04_R1',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Martengale'),
      'typeline' => clienttranslate('Character - Animal Spirit'),
      'type' => CHARACTER,
      'subtypes' => [ANIMAL, SPIRIT],
      'effectDesc' => clienttranslate('If you would roll a die, you may add 1 to its result. (Choose after you see the result.)'),
      'supportDesc' => clienttranslate(
        '{D} : The next card you play this turn costs {1} less. (Discard me from Reserve to do this.)'
      ),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 0,
      'costHand' => 1,
      'costReserve' => 1,
    ];
  }
}
