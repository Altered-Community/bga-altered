<?php
namespace ALT\Cards\MU;

class MU_Rare_Ogun extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_06_R2',
      'asset' => 'ALT_CORE_B_AX_06_R2',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Ogun'),
      'typeline' => clienttranslate('Character - Engineer Deity'),
      'type' => CHARACTER,
      'subtypes' => [ENGINEER, DEITY],
      'flavorText' => clienttranslate('With every blow of his hammer, Ogun forges the Axiom\'s destiny.'),
      'effectDesc' => clienttranslate('{J} #Plants# you control gain 1 boost$[BB].'),
      'forest' => 2,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
