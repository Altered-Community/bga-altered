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
      'name' => 'Fen & Crowbar',
      'typeline' => 'Hero',
      'type' => HERO,
      'flavorText' => "When you listen to the voice of the Wind, it always carries you where you're meant to be.",
      'artist' => 'Anh Tung',
      'effectDesc' =>
        'During Morning, draw only one card. Then, put the top card of your deck in your Mana zone instead of a card from your hand.  At Noon — $[RESUPPLY].  Ignore my abilities during the first Day.',
    ];
  }
}
