<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_AoifeFireAvatar extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_BISE_B_BR_56_C',
      'asset'  => 'ALT_BISE_B_BR_56_C',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Aoife, Fire Avatar"),
      'typeline' => clienttranslate("Character - Adventurer Elemental"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('When the Firebird\'s spark ignites within you, that\'s when you become worthy of joining the Phoenixian Guard.'),
      'artist' => "Justice Wong",
      'extension' => 'WFTM',
      'subtypes'  => [ADVENTURER, ELEMENTAL],
      'effectDesc' => clienttranslate('$<SCOUT_2> {2}.  {J} You may have another target Character lose <FLEETING> and gain 1 boost.'),
      'forest' => 5,
      'mountain' => 4,
      'ocean' => 5,
      'costHand' => 5,
      'costReserve' => 5,
      'scout' => 2,
      'effectPlayed' => FT::ACTION(TARGET, [
        'upTo' => true,
        'excludeSelf' => true,
        'effect' => FT::SEQ(FT::LOOSE(EFFECT, FLEETING), FT::GAIN(EFFECT, BOOST)),
      ]),
    ];
  }
}
