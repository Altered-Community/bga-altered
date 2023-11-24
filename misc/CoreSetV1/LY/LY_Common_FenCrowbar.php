<?php
namespace ALT\Cards\LY;

class LY_Common_FenCrowbar extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_03_C',
      'asset' => 'ALT_CORE_B_LY_03_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Fen & Crowbar'),
      'type' => HERO,
      'effectDesc' => clienttranslate(
        'During Awakening, instead of your draw step, put the top card of your deck in your Mana Orbs, then draw a card, then $[RESUPPLY].  This Ability doesn\'t Trigger during the first Awakening.'
      ),
    ];
  }
}
