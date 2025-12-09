<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Common_RekaAgronomist extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_MU_91_C',
      'asset'  => 'ALT_DUSTER_B_MU_91_C',

      'faction'  => FACTION_MU,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Reka Agronomist"),
      'typeline' => clienttranslate("Character - Engineer"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"By crossing the fruits of the two world trees, we could obtain a fertile specimen."'),
      'artist' => "Matteo Spirito",
      'extension' => 'SDU',
      'subtypes'  => [ENGINEER],
      'effectDesc' => clienttranslate('{H} Create a <MANASEED> token in target opponent\'s Landmarks. (It\'s a Permanent with \"{T}, Sacrifice me: Ready a Mana Orb.\")'),
      'forest' => 4,
      'mountain' => 4,
      'ocean' => 4,
      'costHand' => 3,
      'costReserve' => 3,
      'effectHand' => FT::ACTION(INVOKE_TOKEN, [
        'pId' => 'source',
        'targetPlayer' => OPPONENT,
        'tokenType' => 'NE_Common_Manaseed',
        'targetLocation' => [LANDMARK],
      ]),
    ];
  }
}
