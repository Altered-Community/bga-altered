<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_BravosHarpooner extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_BR_73_C',
      'asset'  => 'ALT_CYCLONE_B_BR_73_C',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Bravos Harpooner"),
      'typeline' => clienttranslate("Character - Adventurer"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('Without explosive charges, these harpoons wouldn\'t even make a dent in Halua\'s hide.'),
      'artist' => "Justice Wong",
      'extension' => 'SO',
      'subtypes'  => [ADVENTURER],
      'effectDesc' => clienttranslate('{H} You may <RUSH> to <SABOTAGE_INF>. (Rush means playing another card immediately. If you do, discard up to one target card from a Reserve.)'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 3,
      'effectHand' => FT::SEQ_OPTIONAL(
        FT::RUSH(),
        FT::ACTION(TARGET, [
          'targetType' => [CHARACTER, SPELL, TOKEN, PERMANENT],
          'targetLocation' => [RESERVE],
          'upTo' => true,
          'effect' => FT::ACTION(DISCARD, []),
        ]),
      )
    ];
  }
}
