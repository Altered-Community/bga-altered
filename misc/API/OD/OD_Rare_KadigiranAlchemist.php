<?php
namespace ALT\Cards\OD;

class OD_Rare_KadigiranAlchemist extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_12_R2',
      'asset' => 'ALT_CORE_B_YZ_12_R2',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Kadigiran Alchemist'),
      'typeline' => clienttranslate('Character - Mage'),
      'type' => CHARACTER,
      'subtypes' => [MAGE],
      'effectDesc' => clienttranslate('{M} I gain 3 boosts.'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
