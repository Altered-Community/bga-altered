<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Common_TheTortoise extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_YZ_69_C',
      'asset'  => 'ALT_CYCLONE_B_YZ_69_C',

      'faction'  => FACTION_YZ,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("The Tortoise"),
      'typeline' => clienttranslate("Character - Animal"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"I\'ll gladly give you the spot, there\'s no use getting in a stew."'),
      'artist' => "Matteo Spirito",
      'extension' => 'SO',
      'subtypes'  => [ANIMAL],
      'supportDesc' => clienttranslate('{D} : <AFTER_YOU>. (Discard me from Reserve to end your turn as if you had played a card.)'),
      'supportIcon' => 'discard',
      'forest' => 0,
      'mountain' => 0,
      'ocean' => 3,
      'costHand' => 2,
      'costReserve' => 2,
      'effectSupport' => FT::ACTION(AFTER_YOU, []),
    ];
  }
}
