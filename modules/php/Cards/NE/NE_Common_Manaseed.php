<?php

namespace ALT\Cards\NE;

use ALT\Helpers\FT;

class NE_Common_Manaseed extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_NE_04_C',
      'asset'  => 'ALT_DUSTER_B_NE_04_C',

      'faction'  => FACTION_NE,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Manaseed"),
      'typeline' => clienttranslate("Token Landmark Permanent - Sap"),
      'type'  => PERMANENT,
      'flavorText'  => clienttranslate('The Reka draw all of their riches from its Juice.'),
      'artist' => "Taras Susak",
      'extension' => 'SDU',
      'subtypes'  => [SAP, LANDMARK],
      'token' => true,
      'effectDesc' => clienttranslate('{T}, Sacrifice me: Ready a Mana Orb.'),
      'effectTap' => FT::SEQ(
        FT::ACTION(DISCARD, ['cardId' => ME, 'desc' => 'sacrifice']),
        FT::ACTION(READY, ['cardId' => MANA]),
      )
    ];
  }
}
