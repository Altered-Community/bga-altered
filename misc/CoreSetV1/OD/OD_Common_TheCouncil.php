<?php

namespace ALT\Cards\OD;

class OD_Common_TheCouncil extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_12_C',
      'asset' => 'ALT_CORE_B_OR_12_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('The Council'),
      'type' => CHARACTER,
      'subtype' => BUREAUCRAT,
      'effectDesc' => clienttranslate(
        'If I am in your Hero Expedition, Companion Expeditions can\'t advance. If I am in your Companion Expedition, Hero Expeditions can\'t advance.'
      ),
      'supportDesc' => clienttranslate('{D} : Draw a card. (Discard me from your Reserve to activate this effect)'),
      'forest' => 4,
      'mountain' => 4,
      'ocean' => 4,
      'costHand' => 6,
      'costReserve' => 6,
    ];
  }
}
