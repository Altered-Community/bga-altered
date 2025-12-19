<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_MothDecoy extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_YZ_100_R1',
      'asset'  => 'ALT_DUSTER_B_YZ_100_R',

      'faction'  => FACTION_YZ,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Moth Decoy"),
      'typeline' => clienttranslate("Spell - Conjuration"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('"You\'re not the only ones who can use substitution." — Moyo'),
      'artist' => "Fahmi Fauzi",
      'extension' => 'SDU',
      'subtypes'  => [CONJURATION],
      'effectDesc' => clienttranslate('You may exhaust ({T}) a card from your Reserve to play me for {1} less.  Create a <MANA_MOTH> Illusion token in target Expedition.'),
      'costHand' => 4,
      'costReserve' => 4,
      'changedStats' => ['costReserve'],
      'costReductionTap' => 1,
      'effectPlayed' => FT::ACTION(INVOKE_TOKEN, [
        'pId' => 'source',
        'tokenType' => 'YZ_Common_ManaMoth',
        'targetLocation' => STORMS,
      ]),
    ];
  }
}
