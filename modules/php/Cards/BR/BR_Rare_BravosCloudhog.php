<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_BravosCloudhog extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_BR_91_R1',
      'asset'  => 'ALT_DUSTER_B_BR_91_R',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Bravos Cloudhog"),
      'typeline' => clienttranslate("Character - Adventurer Rogue"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"Ladies and gentlemen, you are about to experience some turbulence."'),
      'artist' => "Zael",
      'extension' => 'SDU',
      'subtypes'  => [ADVENTURER, ROGUE],
      'effectDesc' => clienttranslate('{R} <SABOTAGE>. If you discarded a Character this way, I gain #2 boosts, otherwise I gain 1 boost.#'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 3,
      'costHand' => 2,
      'costReserve' => 4,
      'changedStats' => ['ocean'],
      'effectReserve' =>
      FT::XOR(
        FT::ACTION(TARGET, [
          'targetType' => [SPELL, PERMANENT],
          'targetLocation' => [RESERVE],
          'upTo' => true,
          'effect' => FT::ACTION(DISCARD, []),
        ]),
        FT::ACTION(TARGET, [
          'targetType' => [CHARACTER],
          'targetLocation' => [RESERVE],
          'upTo' => true,
          'effect' => FT::SEQ(FT::ACTION(DISCARD, []), FT::GAIN(ME, BOOST, 1))
        ]),
      )
    ];
  }
}
