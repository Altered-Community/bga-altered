<?php
namespace ALT\Cards\AX;

class AX_Common_FoundryEngineer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_05_C',
      'asset' => 'ALT_CORE_B_AX_05_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => 'Foundry Engineer',
      'typeline' => 'Character - Engineer',
      'type' => CHARACTER,
      'flavorText' => 'Behind every Axiom masterwork, there are Foundry Engineers.',
      'artist' => 'Damian Audino',
      'subtypes' => [ENGINEER],
      'effectDesc' => '{R} The next Permanent you play this Afternoon costs {1} less.',
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
