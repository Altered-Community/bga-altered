<?php
namespace ALT\Cards\MU;

class MU_Base_Hesperide extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'USA2023_MU_2_1_24',
      'asset' => 'MU-42_Hesperide_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_MU,
      'name' => clienttranslate('Hesperide'),
      'type' => EXPLORER,
      'subtype' => 'Plant',
      'typeline' => 'Explorer Base - Plant',
      'rarity' => RARITY_BASE,
      'effectDesc' => clienttranslate('{M} [Gift] — Target opponent draws a card.'),

      'forest' => 3,
      'mountain' => 5,
      'ocean' => 5,
      'costHand' => 3,
      'costMemory' => 3,
    ];
  }
}
