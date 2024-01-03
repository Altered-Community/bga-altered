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
      'typeline' => clienttranslate('Character - Elemental'),
      'type' => CHARACTER,
      'subtypes' => [ELEMENTAL],
      'flavorText' => clienttranslate('In true Axiom fashion, Kelon Elementals like to put everything to the taste.'),
      'effectDesc' => clienttranslate('{H} Put a card from your hand in Reserve.'),
      'forest' => 1,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
