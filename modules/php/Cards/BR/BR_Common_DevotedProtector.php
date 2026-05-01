<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_DevotedProtector extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_BR_110_C',
      'asset'  => 'ALT_EOLE_B_BR_110_C',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Devoted Protector"),
      'typeline' => clienttranslate("Character - Soldier"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate(''),
      'artist' => "Martin Mottet",
      'extension' => 'ROC',
      'subtypes'  => [SOLDIER],
      'forest' => 0,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 1,
      'costReserve' => 1,
    ];
  }
}
