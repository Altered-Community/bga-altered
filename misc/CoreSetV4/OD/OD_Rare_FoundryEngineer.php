<?php
namespace ALT\Cards\OD;

class OD_Rare_FoundryEngineer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_05_R2',
      'asset' => 'ALT_CORE_B_AX_05_R1',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => 'Foundry Engineer',
      'typeline' => 'Character - Engineer',
      'type' => CHARACTER,
      'flavorText' => 'Behind every Axiom masterwork, there are Foundry Engineers.',
      'artist' => 'Damian Audino',
      'subtypes' => [ENGINEER],
      'effectDesc' => '{R} The next Permanent you play this Afternoon costs #{2} less#.',
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
