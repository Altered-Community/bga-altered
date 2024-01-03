<?php
namespace ALT\Cards\BR;

class BR_Rare_KaibaraAsgarthanLeviathan extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_24_R1',
      'asset' => 'ALT_CORE_B_BR_24_R1',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Kaibara, Asgarthan Leviathan'),
      'typeline' => clienttranslate('Character - Leviathan'),
      'type' => CHARACTER,
      'subtypes' => [LEVIATHAN],
      'effectDesc' => clienttranslate(
        '[Gigantic]. (I am considered present in each of your Expeditions.)  [Tough X], where X is the numbers of regions between your Hero and Companion. (If your Hero and Companion Expeditions are adjacent, X equals 0. Your opponent\'s Spells and abilities that target me cost {X} more.)'
      ),
      'forest' => 8,
      'mountain' => 8,
      'ocean' => 8,
      'costHand' => 9,
      'costReserve' => 9,
    ];
  }
}
