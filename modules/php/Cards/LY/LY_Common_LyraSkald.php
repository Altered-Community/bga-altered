<?php
namespace ALT\Cards\LY;

class LY_Common_LyraSkald extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '70',
      'asset' => 'LY-Mnemos-Skald-C',
      'frameSize' => 1,

      'faction' => FACTION_LY,
      'name' => clienttranslate('Lyra Skald'),
      'typeline' => clienttranslate('Common - Artist'),
      'rarity' => RARITY_COMMON,
      'type' => CHARACTER,
      'subtype' => 'Artist',

      'forest' => 3,
      'mountain' => 0,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
