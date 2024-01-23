<?php
namespace ALT\Cards\AX;

class AX_Rare_AxiomSalvager extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_08_R1',
      'asset' => 'ALT_CORE_B_AX_08_R1',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Axiom Salvager'),
      'typeline' => clienttranslate('Character - Engineer'),
      'type' => CHARACTER,
      'subtypes' => [ENGINEER],
      'flavorText' => clienttranslate('The Axiom\'s limited ressources pushed them to reuse whatever could be.'),
      'effectDesc' => clienttranslate('{R} $[RESUPPLY].'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 0,
      'costHand' => 1,
      'costReserve' => 1,
      'changedStats' => ['ocean', 'costReserve'],
    ];
  }
}
