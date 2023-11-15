<?php
namespace ALT\Cards\BR;

class BR_Common_Achilles extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_21_C',
      'asset' => 'ALT_CORE_B_BR_21_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Achilles'),
      'type' => CHARACTER,
      'subtype' => ADVENTURER,
      'effectDesc' => clienttranslate('$[TOUGH_1].  '),
      'forest' => 6,
      'mountain' => 6,
      'ocean' => 6,
      'costHand' => 5,
      'costMemory' => 5,
    ];
  }
}
