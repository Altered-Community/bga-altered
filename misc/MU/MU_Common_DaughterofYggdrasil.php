<?php
namespace ALT\Cards\MU;

class MU_Common_DaughterofYggdrasil extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '109',
      'asset' => 'MU-42_Hesperide_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_MU,
      'name' => clienttranslate('Daughter of Yggdrasil'),
      'type' => CHARACTER,
      'subtype' => 'Plant',
      'typeline' => 'Common - Plant',
      'rarity' => RARITY_COMMON,

      'effectDesc' => clienttranslate('{M} [Gift]�� Each opponent draws a card.'),
      'forest' => 3,
      'mountain' => 5,
      'ocean' => 5,
      'costHand' => 3,
      'costMemory' => 3,
    ];
  }
}
