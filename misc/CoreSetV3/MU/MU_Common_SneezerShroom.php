<?php
namespace ALT\Cards\MU;

class MU_Common_SneezerShroom extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_08_C',
      'asset' => 'ALT_CORE_B_MU_08_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Sneezer Shroom'),
      'typeline' => clienttranslate('Character - Plant'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate('"Achoo!"'),
      'artist' => 'Zero Wen',
      'subtypes' => [PLANT],
      'effectDesc' => clienttranslate('{J} I gain $[ANCHORED].'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
