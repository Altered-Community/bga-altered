<?php
namespace ALT\Cards\AX;

class AX_Common_TinkerBell extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '5',
      'asset' => 'AX-09-Tinkder-Bell-C',
      'frameSize' => 1,

      'faction' => FACTION_AX,
      'name' => clienttranslate('Tinker Bell'),
      'typeline' => clienttranslate('Common - Fairy'),
      'rarity' => RARITY_COMMON,
      'type' => CHARACTER,
      'subtype' => 'Fairy',

      'forest' => 3,
      'mountain' => 2,
      'ocean' => 0,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
