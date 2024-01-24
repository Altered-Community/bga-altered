<?php
namespace ALT\Cards\LY;

class LY_Rare_MagicalTraining extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_19_R2',
      'asset' => 'ALT_CORE_B_YZ_19_R1',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => 'Magical Training',
      'typeline' => 'Spell - Conjuration',
      'type' => SPELL,
      'flavorText' => 'Without practice, the gift of Alteration will come to nothing.',
      'artist' => 'Zero Wen',
      'subtypes' => [CONJURATION],
      'effectDesc' => 'Draw a card.',
      'costHand' => 1,
      'costReserve' => 3,
    ];
  }
}
