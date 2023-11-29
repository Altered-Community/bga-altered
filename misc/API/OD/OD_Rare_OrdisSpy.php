<?php
namespace ALT\Cards\OD;

class OD_Rare_OrdisSpy extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_14_R1',
      'asset' => 'ALT_CORE_B_OR_14_R1',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Ordis Spy'),
      'typeline' => clienttranslate('Character - Citizen'),
      'type' => CHARACTER,
      'subtypes' => [CITIZEN],
      'effectDesc' => clienttranslate(
        '{M} [Sabotage].  {S} Create a [Ordis Recruit 1/1/1] Soldier token in my Expedition. (Discard up to one target card from a Reserve.)'
      ),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
