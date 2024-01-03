<?php
namespace ALT\Cards\AX;

class AX_Common_AxiomSalvager extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_08_C',
      'asset' => 'ALT_CORE_B_AX_08_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Axiom Salvager'),
      'typeline' => clienttranslate('Character - Engineer'),
      'type' => CHARACTER,
      'subtypes' => [ENGINEER],
      'flavorText' => clienttranslate('The Axiom\'s limited ressources pushed them to reuse whatever could be.'),
      'effectDesc' => clienttranslate('{R} [Resupply]. (Put the top card of your deck in Reserve.)'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 1,
      'costReserve' => 1,
    ];
  }
}
