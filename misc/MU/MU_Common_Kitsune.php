<?php
namespace ALT\Cards\MU;

class MU_Common_Kitsune extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '98',
      'asset' => 'MU-05-Kitsune-C',
      'frameSize' => 1,

      'faction' => FACTION_MU,
      'name' => clienttranslate('Kitsune'),
      'typeline' => clienttranslate('Common - Spirit'),
      'rarity' => RARITY_COMMON,
      'type' => CHARACTER,
      'subtype' => 'Spirit',

      'effectDesc' => clienttranslate('{M} [Gift] - Each player draws a card.'),
      'forest' => 0,
      'mountain' => 3,
      'ocean' => 2,
      'costHand' => 2,
      'costMemory' => 2,
      'effectHand' => FT::ACTION(DRAW, []),
    ];
  }
}
