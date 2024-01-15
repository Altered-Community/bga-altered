<?php
namespace ALT\Cards\LY;

class LY_Rare_KaibaraAsgarthanLeviathan extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_24_R2',
      'asset' => 'ALT_CORE_B_BR_24_R2',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Kaibara, Asgarthan Leviathan'),
      'typeline' => clienttranslate('Character - Leviathan'),
      'type' => CHARACTER,
      'subtypes' => [LEVIATHAN],
      'effectDesc' => clienttranslate(
        '[Gigantic]. (I am considered present in each of your Expeditions.)  [Tough X], where X is the numbers of regions between your Hero and Companion. (If they are adjacent, X equals 0. Your opponent\'s Spells and abilities that target me cost {X} more.)'
      ),
      'forest' => 6,
      'mountain' => 6,
      'ocean' => 6,
      'costHand' => 8,
      'costReserve' => 8,
    ];
  }
}
