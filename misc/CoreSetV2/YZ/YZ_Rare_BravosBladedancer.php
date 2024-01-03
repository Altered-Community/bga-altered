<?php
namespace ALT\Cards\YZ;

class YZ_Rare_BravosBladedancer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_16_R2',
      'asset' => 'ALT_CORE_B_BR_16_R2',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Bravos Bladedancer'),
      'typeline' => clienttranslate('Character - Soldier'),
      'type' => CHARACTER,
      'subtypes' => [SOLDIER],
      'effectDesc' => clienttranslate('$[SEASONED].  {J} I gain 1 boost.'),
      'forest' => 0,
      'mountain' => 0,
      'ocean' => 0,
      'costHand' => 1,
      'costReserve' => 2,
      'changedStats' => ['costReserve'],
    ];
  }
}
