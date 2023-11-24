<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

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
      'type' => CHARACTER,
      'subtype' => PLANT,
      'effectDesc' => clienttranslate('{J} I become $[ANCHORED].  '),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 2,
      'effectPlayed' => FT::GAIN($this, ANCHORED),
    ];
  }
}
