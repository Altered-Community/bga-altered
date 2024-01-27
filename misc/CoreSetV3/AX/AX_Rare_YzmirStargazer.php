<?php
namespace ALT\Cards\AX;

class AX_Rare_YzmirStargazer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_08_R2',
      'asset' => 'ALT_CORE_B_YZ_08_R1',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => 'Yzmir Stargazer',
      'typeline' => 'Character - Mage Scholar',
      'type' => CHARACTER,
      'flavorText' => 'She won\'t read the future in the stars, she\'ll change it herself.',
      'artist' => 'HuoMiao Studio',
      'subtypes' => [MAGE, SCHOLAR],
      'forest' => 1,
      'mountain' => 2,
      'ocean' => 1,
      'costHand' => 1,
      'costReserve' => 1,
      'changedStats' => ['costHand'],
    ];
  }
}
