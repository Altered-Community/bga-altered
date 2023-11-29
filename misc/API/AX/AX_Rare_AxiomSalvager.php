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
      'effectDesc' => clienttranslate('{S} [Resupply]. (Put the top card of your deck in your Reserve.)'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 0,
      'costHand' => 1,
      'costReserve' => 1,
    ];
  }
}
