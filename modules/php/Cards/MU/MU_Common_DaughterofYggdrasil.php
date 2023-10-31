<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Common_DaughterofYggdrasil extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '109',
      'asset' => 'MU-12-Hesperide-C',
      'frameSize' => 1,

      'faction' => FACTION_MU,
      'name' => clienttranslate('Daughter of Yggdrasil'),
      'typeline' => clienttranslate('Common - Plant'),
      'rarity' => RARITY_COMMON,
      'type' => CHARACTER,
      'subtype' => 'Plant',

      'effectDesc' => clienttranslate('{M} [Gift] - Each opponent draws a card.'),
      'forest' => 3,
      'mountain' => 5,
      'ocean' => 5,
      'costHand' => 3,
      'costMemory' => 3,
      'effectHand' => FT::ACTION(DRAW, ['players' => OPPONENT]),
    ];
  }
}
