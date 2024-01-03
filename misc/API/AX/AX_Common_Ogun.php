<?php
namespace ALT\Cards\AX;

class AX_Common_Ogun extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_06_C',
      'asset' => 'ALT_CORE_B_AX_06_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Ogun'),
      'typeline' => clienttranslate('Character - Engineer Deity'),
      'type' => CHARACTER,
      'subtypes' => [ENGINEER, DEITY],
      'flavorText' => clienttranslate('With every blow of his hammer, Ogun forges the Axiom\'s destiny.'),
      'effectDesc' => clienttranslate(
        '{J} Robots you control gain 1 boost[]. (A boost is a +1/+1/+1 counter. Remove it when it leaves the Expedition zone.)'
      ),
      'forest' => 2,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
