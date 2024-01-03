<?php
namespace ALT\Cards\BR;

class BR_Rare_IssunBoshi extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_05_R1',
      'asset' => 'ALT_CORE_B_BR_05_R1',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Issun-Boshi'),
      'typeline' => clienttranslate('Character - Adventurer'),
      'type' => CHARACTER,
      'subtypes' => [ADVENTURER],
      'effectDesc' => clienttranslate('#{R} Target Character gains 1 boost$[BB].#'),
      'supportDesc' => clienttranslate(
        '{D} : The next Character you play this turn gains 1 boost. (Discard me from Reserve to do this.)'
      ),
      'forest' => 0,
      'mountain' => 0,
      'ocean' => 2,
      'costHand' => 1,
      'costReserve' => 2,
      'changedStats' => ['costReserve'],
    ];
  }
}
