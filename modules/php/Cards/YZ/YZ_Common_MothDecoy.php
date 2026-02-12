<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Common_MothDecoy extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_YZ_100_C',
      'asset'  => 'ALT_DUSTER_B_YZ_100_C',

      'faction'  => FACTION_YZ,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Moth Decoy"),
      'typeline' => clienttranslate("Spell - Conjuration"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('"You\'re not the only ones who can use substitution." — Moyo'),
      'artist' => "Fahmi Fauzi",
      'extension' => 'SDU',
      'subtypes'  => [CONJURATION],
      'effectDesc' => clienttranslate('You may exhaust ({T}) a card from your Reserve to play me for {1} less.  Create a <MANA_MOTH> Illusion token in target Expedition.'),
      'costHand' => 4,
      'costReserve' => 5,
      'costReductionTap' => 1,
      'effectPlayed' => FT::ACTION(INVOKE_TOKEN, [
        'pId' => 'source',
        'tokenType' => 'YZ_Common_ManaMoth',
        'targetLocation' => STORMS,
      ]),
    ];
  }
}
