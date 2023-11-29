<?php
namespace ALT\Cards\AX;

class AX_Rare_TheOuroborosLyraBastion extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_30_R2',
      'asset' => 'ALT_CORE_B_LY_30_R2',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('The Ouroboros, Lyra Bastion'),
      'typeline' => clienttranslate('Permanent - Landmark'),
      'type' => PERMANENT,
      'subtypes' => [LANDMARK],
      'effectDesc' => clienttranslate(
        '{J} [Resupply].  If you should [Resupply], instead, look at the top two cards of your deck. Put one in your Reserve, and discard the other. (Put the top card of your deck in your Reserve.)'
      ),
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
