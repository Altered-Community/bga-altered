<?php
namespace ALT\Cards\LY;

class LY_Common_OuroborosDealer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_17_C',
      'asset' => 'ALT_CORE_B_LY_17_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Ouroboros Dealer'),
      'type' => CHARACTER,
      'subtype' => CITIZEN,
      'effectDesc' => clienttranslate('{M} Roll a dice, if the result is 4 or more, draw a card, otherwise, $[RESUPPLY].  '),
      'forest' => 0,
      'mountain' => 4,
      'ocean' => 4,
      'costHand' => 4,
      'costMemory' => 4,
    ];
  }
}
