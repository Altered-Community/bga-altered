<?php
namespace ALT\Cards\OD;

class OD_Rare_BabaYaga extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_11_R2',
      'asset' => 'ALT_CORE_B_YZ_11_R1',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => 'Baba Yaga',
      'typeline' => 'Character - Mage',
      'type' => CHARACTER,
      'flavorText' => 'Help or harm? Only the card will tell.',
      'artist' => 'MISSING ARTIST',
      'subtypes' => [MAGE],
      'effectDesc' => '{H} Draw a card.',
      'forest' => 3,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 2,
      'changedStats' => ['forest', 'mountain'],
    ];
  }
}
