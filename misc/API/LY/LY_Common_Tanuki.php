<?php
namespace ALT\Cards\LY;

class LY_Common_Tanuki extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_09_C',
      'asset' => 'ALT_CORE_B_LY_09_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Tanuki'),
      'typeline' => clienttranslate('Character - Spirit'),
      'type' => CHARACTER,
      'subtypes' => [SPIRIT],
      'effectDesc' => clienttranslate('{M} [Sabotage]. (Discard up to one target card from a Reserve.)'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 0,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
