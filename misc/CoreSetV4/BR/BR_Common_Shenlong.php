<?php
namespace ALT\Cards\BR;

class BR_Common_Shenlong extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_22_C',
      'asset' => 'ALT_CORE_B_BR_22_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => 'Shenlong',
      'typeline' => 'Character - Deity Dragon',
      'type' => CHARACTER,
      'flavorText' => 'Be careful what you wish for. There are challenges that even the Bravos prefer to avoid.',
      'artist' => 'HuoMiao Studio',
      'subtypes' => [DEITY, DRAGON],
      'forest' => 8,
      'mountain' => 8,
      'ocean' => 8,
      'costHand' => 6,
      'costReserve' => 6,
    ];
  }
}
