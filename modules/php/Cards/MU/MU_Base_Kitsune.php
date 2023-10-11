<?php
namespace ALT\Cards\MU;

class MU_Base_Kitsune extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => 'USA2023_MU_2_1_18',
      'asset' => 'MU-09_Kitsune_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_MU,
      'name' => clienttranslate('Kitsune'),
      'type' => EXPLORER,
      'subtype' => 'Spirit',
      'typeline' => 'Explorer Base - Spirit',
      'rarity' => RARITY_BASE,
      'effectDesc' => clienttranslate('{M} [Gift] — Each player draws a card.'),

      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 1,
      'costMemory' => 1,
    ];
  }
}
