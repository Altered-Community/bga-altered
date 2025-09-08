<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Common_AegisTemplar extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_BISE_B_OR_54_C',
      'asset'  => 'ALT_BISE_B_OR_54_C',

      'faction'  => FACTION_OD,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Aegis Templar"),
      'typeline' => clienttranslate("Character - Soldier"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('The Templars always ensure that the area is safe.'),
      'artist' => "Taras Susak",
      'extension' => 'WFTM',
      'subtypes'  => [SOLDIER],
      'effectDesc' => clienttranslate('$<SCOUT_1> {1}.  When I leave the Expedition zone — Create an <ORDIS_RECRUIT> Soldier token in my Expedition.'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 3,
      'scout' => 1,
      'effectPassive' => [
        'LeaveExpedition' => [
          'pId' => CONTROLLER,
          'output' =>
          FT::ACTION(INVOKE_TOKEN, [
            'pId' => CONTROLLER,
            'tokenType' => 'OD_Common_OrdisRecruit',
            'targetLocation' => ['source'],
          ]),
        ],
      ],
    ];
  }
}
