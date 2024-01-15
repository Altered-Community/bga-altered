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
      'name' => clienttranslate('Shenlong'),
      'typeline' => clienttranslate('Character - Dragon'),
      'type' => CHARACTER,
      'subtypes' => [DRAGON],
      'forest' => 8,
      'mountain' => 8,
      'ocean' => 8,
      'costHand' => 6,
      'costReserve' => 6,
    ];
  }
}
