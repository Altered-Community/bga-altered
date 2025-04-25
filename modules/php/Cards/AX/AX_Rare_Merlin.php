<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_Merlin extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_BISE_B_YZ_54_R2',
      'asset'  => 'ALT_BISE_B_YZ_54_R',

      'faction'  => FACTION_AX,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Merlin"),
      'typeline' => clienttranslate("Character - Mage"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"You and I both know it has never been about the sword."'),
      'artist' => "Taras Susak",
      'extension' => 'WFTM',
      'subtypes'  => [MAGE],
      'effectDesc' => clienttranslate('$<SCOUT_4> {4}.  {H} You may #discard# target Character #or Permanent.#'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 6,
      'costReserve' => 3,
      'scout' => 4,
      'effectHand' => FT::ACTION(TARGET, [
        'targetType' => [CHARACTER, TOKEN, PERMANENT],
        'effect' => FT::ACTION(DISCARD, []),
      ])
    ];
  }
}
