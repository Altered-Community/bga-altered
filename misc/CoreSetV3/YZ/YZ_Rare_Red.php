<?php
namespace ALT\Cards\YZ;

class YZ_Rare_Red extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_10_R2',
      'asset' => 'ALT_CORE_B_BR_10_R1',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => 'Red',
      'typeline' => 'Character - Adventurer',
      'type' => CHARACTER,
      'flavorText' => 'Grandma would be proud.',
      'artist' => 'Jean-Baptiste Andrier',
      'subtypes' => [ADVENTURER],
      'effectDesc' => '$<SEASONED>.',
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
