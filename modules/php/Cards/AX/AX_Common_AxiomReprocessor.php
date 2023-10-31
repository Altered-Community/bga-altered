<?php
namespace ALT\Cards\AX;

class AX_Common_AxiomReprocessor extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '24',
      'asset' => 'AX-25-Recycling-Mill-C',
      'frameSize' => 1,

      'faction' => FACTION_AX,
      'name' => clienttranslate('Axiom Reprocessor'),
      'typeline' => '',
      'rarity' => RARITY_COMMON,
      'type' => PERMANENT,
      'subtype' => '',

      'effectDesc' => clienttranslate('At Dawn - [Resupply].'),
      'reminders' => clienttranslate('(Resupply: Put the top card of your deck in your Reserve.)'),
      'costHand' => 4,
      'costMemory' => 4,
    ];
  }
}
