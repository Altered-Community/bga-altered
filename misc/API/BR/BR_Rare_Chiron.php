<?php
namespace ALT\Cards\BR;

class BR_Rare_Chiron extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_11_R1',
      'asset' => 'ALT_CORE_B_BR_11_R1',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Chiron'),
      'typeline' => clienttranslate('Character - Trainer'),
      'type' => CHARACTER,
      'subtypes' => [TRAINER],
      'effectDesc' => clienttranslate(
        '{J} Up to two target Characters gain 1 boost[]. (A boost is a +1/+1/+1 counter. Remove it when it leaves the Expedition zone.)'
      ),
      'forest' => 1,
      'mountain' => 0,
      'ocean' => 0,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
