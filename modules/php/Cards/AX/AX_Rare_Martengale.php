<?php

namespace ALT\Cards\AX;

class AX_Rare_Martengale extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_04_R2',
      'asset' => 'ALT_CORE_B_LY_04_R',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Martengale'),
      'typeline' => clienttranslate('Character - Spirit Animal'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate('Spotting a martengale is always a good omen.'),
      'artist' => 'Nestor Papatriantafyllou',
      'subtypes' => [SPIRIT, ANIMAL],
      'supportDesc' => clienttranslate(
        '{D} : The next card you play this turn costs {1} less. (Discard me from Reserve to do this.)'
      ),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 0,
      'costHand' => 1,
      'costReserve' => 1,
      'supportIcon' => 'discard',
      'effectSupport' => [
        'action' => SPECIAL_EFFECT,
        'args' => ['effect' => 'costReduction', 'args' => ['type' => ALL, 'reduction' => 1]],
      ],
    ];
  }
}
