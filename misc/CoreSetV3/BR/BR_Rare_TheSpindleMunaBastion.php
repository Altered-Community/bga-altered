<?php
namespace ALT\Cards\BR;

class BR_Rare_TheSpindleMunaBastion extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_30_R2',
      'asset' => 'ALT_CORE_B_MU_30_R1',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('The Spindle, Muna Bastion'),
      'typeline' => clienttranslate('Permanent - Landmark'),
      'type' => PERMANENT,
      'flavorText' => clienttranslate(
        'Within the Spindle\'s trunk is the Bark Refuge, the sanctuary where the Muna converse with sentient plants.'
      ),
      'artist' => 'Ba Vo',
      'subtypes' => [LANDMARK],
      'effectDesc' => clienttranslate('Characters you control have $<TOUGH_2>. (Cards in Reserve are not controlled.)'),
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
