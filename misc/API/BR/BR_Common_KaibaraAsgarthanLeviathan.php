<?php
namespace ALT\Cards\BR;

class BR_Common_KaibaraAsgarthanLeviathan extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_24_C',
      'asset' => 'ALT_CORE_B_BR_24_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Kaibara, Asgarthan Leviathan'),
      'typeline' => clienttranslate('Character - Leviathan'),
      'type' => CHARACTER,
      'subtypes' => [LEVIATHAN],
      'effectDesc' => clienttranslate(
        '[Gigantic].  [Tough X], where X is the numbers of regions between your Hero and Companion.  (If your Hero and Companion Expeditions are adjacent, X equals 0.) (I am considered present in each of your Expeditions.Your opponent\'s Spells and abilities that target me cost {X} more.)'
      ),
      'forest' => 6,
      'mountain' => 6,
      'ocean' => 6,
      'costHand' => 8,
      'costReserve' => 8,
    ];
  }
}
