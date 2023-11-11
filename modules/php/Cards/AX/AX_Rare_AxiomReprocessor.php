<?php
namespace ALT\Cards\AX;

class AX_Rare_AxiomReprocessor extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '31',
      'asset' => 'AX-25-Recycling-Mill-R',
      'frameSize' => 1,

      'faction' => FACTION_AX,
      'name' => clienttranslate('Axiom Reprocessor'),
      'typeline' => '',
      'rarity' => RARITY_RARE,
      'type' => PERMANENT,
      'subtype' => '',

      'effectDesc' => clienttranslate('[G]{J} [Resupply].[/G]  At Dawn - Activate my {J} effect.'),
      'reminders' => clienttranslate('(Fleeting: If I would be sent to Reserve, banish me instead.)'),
      'costHand' => 4,
      'costReserve' => 4,
    ];
  }
}
