<?php
namespace ALT\Cards\MU;

class MU_Rare_LyraThespian extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_05_R2',
      'asset' => 'ALT_CORE_B_LY_05_R1',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => 'Lyra Thespian',
      'typeline' => 'Character - Artist',
      'type' => CHARACTER,
      'flavorText' => '"All the world’s a stage."',
      'artist' => 'Rémi Jacquot',
      'subtypes' => [ARTIST],
      'effectDesc' => '{J} If you control #two or more [BOOSTED_MP] Characters#, I gain #2 boosts$[BB]#.',
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
