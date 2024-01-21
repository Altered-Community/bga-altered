<?php
namespace ALT\Cards\MU;

class MU_Common_DaughterofYggdrasil extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_12_C',
      'asset' => 'ALT_CORE_B_MU_12_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Daughter of Yggdrasil'),
      'typeline' => clienttranslate('Character - Plant'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate('The children of Yggdrasil now take care of the world trees.'),
      'artist' => 'Nestor Papatriantafyllou',
      'subtypes' => [PLANT],
      'effectDesc' => clienttranslate('{H} Target opponent draws a card.'),
      'forest' => 5,
      'mountain' => 5,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
