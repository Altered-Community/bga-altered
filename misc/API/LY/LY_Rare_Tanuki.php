<?php
namespace ALT\Cards\LY;

class LY_Rare_Tanuki extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_09_R1',
      'asset' => 'ALT_CORE_B_LY_09_R1',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Tanuki'),
      'typeline' => clienttranslate('Character - Spirit'),
      'type' => CHARACTER,
      'subtypes' => [SPIRIT],
      'effectDesc' => clienttranslate(
        '{M} [Sabotage].  {S} Roll a die. On a 4 or more, [Sabotage]. (Discard up to one target card from a Reserve.)'
      ),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 0,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
