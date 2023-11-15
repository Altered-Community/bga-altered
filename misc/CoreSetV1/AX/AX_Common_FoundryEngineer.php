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
      'name' => clienttranslate('Foundry Engineer'),
      'type' => CHARACTER,
      'subtype' => ENGINEER,
      'effectDesc' => clienttranslate('{S} The next Permanent you play this Day costs {1} less.  '),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 1,
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}
