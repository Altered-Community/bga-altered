<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_ShiramunTechMonk extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_AX_111_C',
      'asset'  => 'ALT_EOLE_B_AX_111_C',

      'faction'  => FACTION_AX,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Shiramun, Tech Monk"),
      'typeline' => clienttranslate("Character - Engineer"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate(''),
      'artist' => "Tristan Bideau",
      'extension' => 'ROC',
      'subtypes'  => [ENGINEER],
      'effectDesc' => clienttranslate('{H} You may put a card from your hand in Reserve to <SABOTAGE_INF>. (Discard up to one card from a Reserve.)'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 2,
    ];
  }
}
