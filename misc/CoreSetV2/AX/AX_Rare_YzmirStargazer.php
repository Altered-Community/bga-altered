<?php
namespace ALT\Cards\AX;

class AX_Rare_YzmirStargazer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_08_R2',
      'asset' => 'ALT_CORE_B_YZ_08_R2',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Yzmir Stargazer'),
      'typeline' => clienttranslate('Character - Mage Scholar'),
      'type' => CHARACTER,
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
