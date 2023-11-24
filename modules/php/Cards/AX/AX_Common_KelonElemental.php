<?php
namespace ALT\Cards\AX;

class AX_Common_KelonElemental extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_04_C',
      'asset' => 'ALT_CORE_B_AX_04_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Kelon Elemental'),
      'type' => CHARACTER,
      'subtype' => ELEMENTAL,
      'effectDesc' => clienttranslate('{M} Put a card from your hand into your Reserve  '),
      'forest' => 1,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
