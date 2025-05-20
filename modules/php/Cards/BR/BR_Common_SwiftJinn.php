<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_SwiftJinn extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_BISE_B_BR_57_C',
      'asset'  => 'ALT_BISE_B_BR_57_C',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Swift Jinn"),
      'typeline' => clienttranslate("Character - Elemental"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('The quickest solution when you need extra firepower.'),
      'artist' => "Justice Wong",
      'extension' => 'WFTM',
      'subtypes'  => [ELEMENTAL],
      'effectDesc' => clienttranslate('$<SCOUT_3> {3}.  {J} You may put a card from your Reserve in your Mana zone (as an exhausted Mana Orb).'),
      'forest' => 5,
      'mountain' => 5,
      'ocean' => 3,
      'costHand' => 6,
      'costReserve' => 6,
      'scout' => 3,
      'effectPlayed' => FT::ACTION(TARGET, [
        'targetLocation' => [RESERVE],
        'targetType' => [TOKEN, CHARACTER, PERMANENT, SPELL],
        'targetPlayer' => ME,
        'upTo' => true,
        'effect' => FT::ACTION(DISCARD, [
          'destination' => MANA,
          'tapped' => true,
          'force' => true,
        ])
      ])

    ];
  }
}
