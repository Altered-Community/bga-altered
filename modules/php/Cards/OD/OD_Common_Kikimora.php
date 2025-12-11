<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Common_Kikimora extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_OR_95_C',
      'asset'  => 'ALT_DUSTER_B_OR_95_C',

      'faction'  => FACTION_OD,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Kikimora"),
      'typeline' => clienttranslate("Character - Animal Spirit"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('Respect your household, and she will help you. But if you neglect it, beware!'),
      'artist' => "Matteo Spirito",
      'extension' => 'SDU',
      'subtypes'  => [ANIMAL, SPIRIT],
      'supportDesc' => clienttranslate('{D} : Pay {1} less for the next Permanent you play this turn, down to a minimum of {1}. (Discard me from Reserve to do this.)'),
      'supportIcon' => 'discard',
      'forest' => 1,
      'mountain' => 0,
      'ocean' => 0,
      'costHand' => 1,
      'costReserve' => 1,
      'effectSupport' => [
        'action' => SPECIAL_EFFECT,
        'args' => ['effect' => 'costReduction', 'args' => ['type' => PERMANENT, 'reduction' => 1, 'minimum' => 1, 'permanent' => false]],
      ],
    ];
  }
}
