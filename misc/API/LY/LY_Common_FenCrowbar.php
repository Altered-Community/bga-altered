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
      'typeline' => clienttranslate('Hero'),
      'type' => HERO,
      'effectDesc' => clienttranslate(
        'During Morning, draw only one card in the Draw step. Put the top card of your Deck in your Mana zone instead of from your hand.  At Noon — [Resupply].  Ignore my abilities during the first Day. (Put the top card of your deck in your Reserve.)'
      ),
    ];
  }
}
