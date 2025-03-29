<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_TalarianSkater extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_BISE_B_BR_52_R2',
      'asset'  => 'ALT_BISE_B_BR_52_R',

      'faction'  => FACTION_MU,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Talarian Skater"),
      'typeline' => clienttranslate("Character - Messenger"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('To explore the City, adventurers need daily deliveries from the surface.'),
      'artist' => "Exia",
      'extension' => 'WFTM',
      'subtypes'  => [MESSENGER],
      'effectDesc' => clienttranslate('$<SCOUT_1> {1}.  {J} Target Character in play #or in Reserve# gains 1 boost.'),
      'forest' => 3,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 3,
      'changedStats' => ['forest'],
      'scout' => 1,
      'effectPlayed' => FT::ACTION(TARGET, [
        'targetLocation' => [STORM_LEFT, STORM_RIGHT, RESERVE],
        'effect' => FT::ACTION(GAIN, ['type' => BOOST])
      ]),
    ];
  }
}
