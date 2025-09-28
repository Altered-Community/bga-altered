<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Common_Wyvern extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_MU_73_C',
      'asset'  => 'ALT_CYCLONE_B_MU_73_C',

      'faction'  => FACTION_MU,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Wyvern"),
      'typeline' => clienttranslate("Character - Dragon"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('With their fluffy texture and cotton-candy flavor, woollybacks are wyverns\' favorite prey.'),
      'artist' => "Matteo Spirito",
      'extension' => 'SO',
      'subtypes'  => [DRAGON],
      'effectDesc' => clienttranslate('{H} You may send to Reserve target Character with Hand Cost {1} or less.'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 4,
      'costHand' => 4,
      'costReserve' => 3,
      'effectHand' => FT::ACTION(TARGET, ['maxHandCost' => 1, 'upTo' => true, 'effect' => FT::DISCARD_TO_RESERVE()]),
    ];
  }
}
