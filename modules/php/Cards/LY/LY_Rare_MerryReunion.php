<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_MerryReunion extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_BISE_B_LY_58_R1',
      'asset'  => 'ALT_BISE_B_LY_58_R',

      'faction'  => FACTION_LY,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Merry Reunion"),
      'typeline' => clienttranslate("Spell - Conjuration"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('"Dad!" — Sierra'),
      'artist' => "Ina Wong",
      'extension' => 'WFTM',
      'subtypes'  => [CONJURATION],
      'effectDesc' => clienttranslate('#<COOLDOWN>.# (If I go to Reserve after my effect resolves, exhaust me {T}. Exhausted cards can\'t be played and have no Support abilities.)  <RESUPPLY>. If you put a Character in Reserve this way, you may then #put it in your hand.#'),
      'costHand' => 2,
      'costReserve' => 1,
      'changedStats' => ['costReserve'],
      'cooldown' => true,
      'effectPlayed' => FT::ACTION(RESUPPLY, ['characterHand' => true])

    ];
  }
}
