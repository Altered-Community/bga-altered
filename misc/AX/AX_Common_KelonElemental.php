<?php
namespace ALT\Cards\AX;

class AX_Common_KelonElemental extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '2',
      'asset' => 'AX-04-Kelon-Elemental-C',
      'frameSize' => 1,

      'faction' => FACTION_AX,
      'name' => clienttranslate('Kelon Elemental'),
      'typeline' => clienttranslate('Common - Elemental'),
      'rarity' => RARITY_COMMON,
      'type' => CHARACTER,
      'subtype' => 'Elemental',

      'effectDesc' => clienttranslate('{M} Put a card from your hand into your Reserve'),
      'forest' => 1,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}
