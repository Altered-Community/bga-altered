<?php
namespace ALT\Cards\BR;

class BR_Common_Chiron extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_11_C',
      'asset' => 'ALT_CORE_B_BR_11_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Chiron'),
      'typeline' => clienttranslate('Character - Trainer'),
      'type' => CHARACTER,
      'subtypes' => [TRAINER],
      'effectDesc' => clienttranslate(
        '{J} Target Character gains 1 boost[]. (A boost is a +1/+1/+1 counter. Remove it when it leaves the Expedition zone.)'
      ),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
