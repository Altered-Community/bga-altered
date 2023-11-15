<?php
namespace ALT\Cards\MU;

class MU_Common_Aja extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_17_C',
      'asset' => 'ALT_CORE_B_MU_17_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Aja'),
      'type' => CHARACTER,
      'subtype' => DRUID,
      'effectDesc' => clienttranslate('{M} Each player puts the top card of their deck in their Mana Orbs, exhausted.  '),
      'forest' => 4,
      'mountain' => 5,
      'ocean' => 4,
      'costHand' => 4,
      'costMemory' => 4,
    ];
  }
}
