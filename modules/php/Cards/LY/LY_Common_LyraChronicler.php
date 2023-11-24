<?php
namespace ALT\Cards\LY;

class LY_Common_LyraChronicler extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_16_C',
      'asset' => 'ALT_CORE_B_LY_16_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Lyra Chronicler'),
      'type' => CHARACTER,
      'subtype' => CITIZEN,
      'forest' => 4,
      'mountain' => 0,
      'ocean' => 4,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
