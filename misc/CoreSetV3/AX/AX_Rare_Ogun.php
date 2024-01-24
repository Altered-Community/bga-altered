<?php
namespace ALT\Cards\AX;

class AX_Rare_Ogun extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_06_R1',
      'asset' => 'ALT_CORE_B_AX_06_R1',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => 'Ogun',
      'typeline' => 'Character - Engineer Deity',
      'type' => CHARACTER,
      'flavorText' => "With every blow of his hammer, Ogun forges the Axiom's destiny.",
      'artist' => 'Edward Cheekokseang',
      'subtypes' => [ENGINEER, DEITY],
      'effectDesc' =>
        '{J} #You may pay {2} to create a [BRASSBUG] Robot token in target Expedition.# Then, Robots you control gain 1 boost.',
      'forest' => 2,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
