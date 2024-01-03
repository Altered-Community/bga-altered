<?php
namespace ALT\Cards\LY;

class LY_Rare_KadigiranMageDancer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_07_R2',
      'asset' => 'ALT_CORE_B_YZ_07_R2',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Kadigiran Mage-Dancer'),
      'typeline' => clienttranslate('Character - Mage Soldier'),
      'type' => CHARACTER,
      'subtypes' => [MAGE, SOLDIER],
      'effectDesc' => clienttranslate('When you #roll one or more dice# — I gain 1 boost$[BB].'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
