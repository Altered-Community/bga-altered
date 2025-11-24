<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_ThomasEdison extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_AX_90_C',
      'asset'  => 'ALT_DUSTER_B_AX_90_C',

      'faction'  => FACTION_AX,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Thomas Edison"),
      'typeline' => clienttranslate("Character - Engineer Rogue"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"Thanks to MY new invention, the city is safe!"'),
      'artist' => "Victor Canton",
      'extension' => 'SDU',
      'subtypes'  => [ENGINEER, ROGUE],
      'effectDesc' => clienttranslate('{J} You may discard a Character from your Reserve. If you do, I activate one of its {r} abilities as if it was mine.'),
      'forest' => 5,
      'mountain' => 5,
      'ocean' => 5,
      'costHand' => 5,
      'costReserve' => 5,
      'effectPlayed' => FT::ACTION(TARGET, [
        'upTo' => true,
        'targetType' => [CHARACTER],
        'targetLocation' => [RESERVE],
        'hasEffects' => ['Reserve'],
        'effect' => FT::SEQ(
          FT::ACTION(DISCARD, ['cardId' => EFFECT]),
          FT::ACTION(ACTIVATE_EFFECT, ['effectType' => 'Reserve', 'n' => 1, 'ownEffect' => true]),
        )
      ])
    ];
  }
}
