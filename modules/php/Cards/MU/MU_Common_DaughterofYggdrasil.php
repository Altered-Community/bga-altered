<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

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
      'type' => CHARACTER,
      'subtype' => PLANT,
      'effectDesc' => clienttranslate('{M} Each opponent draws a card.  '),
      'forest' => 5,
      'mountain' => 5,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 3,
      'effectHand' => FT::ACTION(DRAW, ['players' => OPPONENT]),
    ];
  }
}
