<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Common_Merlin extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_BISE_B_YZ_54_C',
      'asset'  => 'ALT_BISE_B_YZ_54_C',

      'faction'  => FACTION_YZ,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Merlin"),
      'typeline' => clienttranslate("Character - Mage"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"You and I both know it has never been about the sword."'),
      'artist' => "Taras Susak",
      'extension' => 'WFTM',
      'subtypes'  => [MAGE],
      'effectDesc' => clienttranslate('$<SCOUT_4> {4}.  {H} You may send target Character to Reserve.'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 6,
      'costReserve' => 3,
      'scout' => 4,
      'effectHand' => FT::ACTION(TARGET, ['effect' => FT::DISCARD_TO_RESERVE()], ['optional' => true]),
    ];
  }
}
