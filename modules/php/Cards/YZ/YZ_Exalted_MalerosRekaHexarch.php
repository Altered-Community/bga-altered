<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Exalted_MalerosRekaHexarch extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_YZ_94_E',
      'asset'  => 'ALT_DUSTER_B_YZ_94_E',

      'faction'  => FACTION_YZ,
      'rarity'  => RARITY_EXALTED,
      'name'  => clienttranslate("Maleros, Reka Hexarch"),
      'typeline' => clienttranslate("Character - Noble Rogue"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"Congratulations. Forcing me to take the field is no small feat."'),
      'artist' => "Justice Wong",
      'extension' => 'SDU',
      'subtypes'  => [NOBLE, ROGUE],
      'effectDesc' => clienttranslate('{H} Pay {7} less for the next Spell you play this Afternoon.'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 4,
      'costHand' => 7,
      'costReserve' => 3,
      'effectHand' => [
        'action' => SPECIAL_EFFECT,
        'args' => ['effect' => 'costReduction', 'args' => ['type' => SPELL, 'reduction' => 7, 'permanent' => true]],
      ]
    ];
  }
}
