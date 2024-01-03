<?php

namespace ALT\Cards\YZ;

class YZ_Common_StubbornDisciple extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '172',
      'asset' => 'YZ-04-StedfastDisciple-C',
      'frameSize' => 3,

      'faction' => FACTION_YZ,
      'name' => clienttranslate('Stubborn Disciple'),
      'typeline' => clienttranslate('Common - Mage'),
      'rarity' => RARITY_COMMON,
      'type' => CHARACTER,
      'subtypes' => 'Mage',

      'supportDesc' => clienttranslate(
        '{D} : The next Spell you play this turn costs {1} less. (Discard me from your Reserve to activate this effect)'
      ),
      'forest' => 0,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 1,
      'costReserve' => 1,
      'effectSupport' => [
        'action' => SPECIAL_EFFECT,
        'args' => ['effect' => 'costReduction', 'args' => ['type' => SPELL, 'reduction' => 1]],
      ],
    ];
  }
}
