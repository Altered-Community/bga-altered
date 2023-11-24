<?php

namespace ALT\Cards\AX;

class AX_Common_Coppelia extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_14_C',
      'asset' => 'ALT_CORE_B_AX_14_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Coppélia'),
      'type' => CHARACTER,
      'subtype' => ROBOT,
      'effectDesc' => clienttranslate('When I\'m sent to Reserve from your hand — Play me for free and I become $[ASLEEP].'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 0,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
