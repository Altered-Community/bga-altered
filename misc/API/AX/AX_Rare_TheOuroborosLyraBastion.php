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
      'flavorText' => clienttranslate(
        'The Expeditionary Corps\' mobile outpost soars high, like a spinning wheel weaving the wind.'
      ),
      'effectDesc' => clienttranslate(
        '{J} [Resupply].  If you would [Resupply], instead, reveal the top two cards of your deck. Put one in Reserve, and discard the other. (Put the top card of your deck in Reserve.)'
      ),
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
