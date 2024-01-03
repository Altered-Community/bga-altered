<?php
namespace ALT\Cards\BR;

class BR_Rare_Ratatoskr extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_04_R1',
      'asset' => 'ALT_CORE_B_BR_04_R1',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Ratatoskr'),
      'typeline' => clienttranslate('Character - Messenger'),
      'type' => CHARACTER,
      'subtypes' => [MESSENGER],
      'effectDesc' => clienttranslate(
        '{R} I gain 3 boost[]s. (A boost is a +1/+1/+1 counter. Remove it when it leaves the Expedition zone.)'
      ),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 1,
      'costReserve' => 3,
    ];
  }
}
