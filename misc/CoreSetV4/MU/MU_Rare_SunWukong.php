<?php
namespace ALT\Cards\MU;

class MU_Rare_SunWukong extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_18_R2',
      'asset' => 'ALT_CORE_B_BR_18_R1',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => 'Sun Wukong',
      'typeline' => 'Character - Deity',
      'type' => CHARACTER,
      'flavorText' => 'Ever the trickster, always the rebel.',
      'artist' => 'Kevin Sidharta',
      'subtypes' => [DEITY],
      'effectDesc' => '{R} #Target Character# gains 2 boosts.',
      'forest' => 2,
      'mountain' => 4,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 4,
    ];
  }
}
