<?php

namespace ALT\Cards\LY;

class LY_Common_MindApotheosis extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_27_C',
      'asset' => 'ALT_CORE_B_LY_27_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Mind Apotheosis'),
      'type' => SPELL,
      'subtype' => SUPPORT,
      'effectDesc' => clienttranslate(
        '$[FLEETING].  Reveal the top 4 cards of your deck. You may play up to two Characters revealed this way for free if possible, in the order of your choice. They gain [FLEETING]. Discard cards that weren\'t played this way. (Don\'t trigger any {M} effects.)  '
      ),
      'costHand' => 9,
      'costReserve' => 9,
    ];
  }
}
