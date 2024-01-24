<?php
namespace ALT\Cards\MU;

class MU_Common_TheSpindleMunaBastion extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_30_C',
      'asset' => 'ALT_CORE_B_MU_30_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => 'The Spindle, Muna Bastion',
      'typeline' => 'Permanent - Landmark',
      'type' => PERMANENT,
      'flavorText' =>
        "Within the Spindle's trunk is the Bark Refuge, the sanctuary where the Muna converse with sentient plants.",
      'artist' => 'Ba Vo',
      'subtypes' => [LANDMARK],
      'effectDesc' => 'Characters you control have $[TOUGH_2].',
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
