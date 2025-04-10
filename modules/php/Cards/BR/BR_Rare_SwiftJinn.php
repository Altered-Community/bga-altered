<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_SwiftJinn extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_BISE_B_BR_57_R1',
      'asset'  => 'ALT_BISE_B_BR_57_R',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Swift Jinn"),
      'typeline' => clienttranslate("Character - Elemental"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('The quickest solution when you need extra firepower.'),
      'artist' => "Justice Wong",
      'extension' => 'WFTM',
      'subtypes'  => [ELEMENTAL],
      'effectDesc' => clienttranslate('$<SCOUT_3> {3}.  {J} You may put a card from your Reserve in your Mana zone as a #ready# Mana Orb.'),
      'forest' => 5,
      'mountain' => 5,
      'ocean' => 5,
      'costHand' => 6,
      'costReserve' => 6,
      'changedStats' => ['ocean'],
      'scout' => 3,
      'effectPlayed' => FT::ACTION(TARGET, [
        'targetLocation' => [RESERVE],
        'targetType' => TYPES,
        'targetPlayer' => ME,
        'upTo' => true,
        'effect' => FT::ACTION(DISCARD, [
          'destination' => MANA,
          'tapped' => false,
          'force' => true,
        ])
      ])
    ];
  }
}
