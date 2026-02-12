<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Common_TheConsulate extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_OR_102_C',
      'asset'  => 'ALT_DUSTER_B_OR_102_C',

      'faction'  => FACTION_OD,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("The Consulate"),
      'typeline' => clienttranslate("Landmark Permanent - Site"),
      'type'  => PERMANENT,
      'flavorText'  => clienttranslate('Here, far from the crowd, is where fruitful negotiations are held between Reka and Asgarthans.'),
      'artist' => "Jean-Baptiste Andrier",
      'extension' => 'SDU',
      'subtypes'  => [SITE, LANDMARK],
      'effectDesc' => clienttranslate('{J} Draw a card.  {T} : Create an <ORDIS_RECRUIT> Soldier token in target Expedition.'),
      'costHand' => 4,
      'costReserve' => 4,
      'effectPlayed' => FT::ACTION(DRAW, ['players' => ME]),
      'effectTap' => FT::ACTION(INVOKE_TOKEN, [
        'pId' => 'source',
        'tokenType' => 'OD_Common_OrdisRecruit',
      ]),
    ];
  }
}
