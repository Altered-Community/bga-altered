<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_AegisTemplar extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_BISE_B_OR_54_R1',
      'asset'  => 'ALT_BISE_B_OR_54_R',

      'faction'  => FACTION_OD,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Aegis Templar"),
      'typeline' => clienttranslate("Character - Soldier"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('The Templars always ensure that the area is safe.'),
      'artist' => "Taras Susak",
      'extension' => 'WFTM',
      'subtypes'  => [SOLDIER],
      'effectDesc' => clienttranslate('#$<SCOUT_2> {2}.#  When I leave the Expedition zone — Create #two# <ORDIS_RECRUIT> Soldier tokens in my Expedition.'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 1,
      'costHand' => 3,
      'costReserve' => 3,
      'changedStats' => ['ocean'],
      'scout' => 2,
      'effectPassive' => [
        'LeaveExpedition' => [
          'pId' => CONTROLLER,
          'output' => FT::SEQ(
            FT::ACTION(INVOKE_TOKEN, [
              'pId' => CONTROLLER,
              'tokenType' => 'OD_Common_OrdisRecruit',
              'targetLocation' => ['source'],
            ]),
            FT::ACTION(INVOKE_TOKEN, [
              'pId' => CONTROLLER,
              'tokenType' => 'OD_Common_OrdisRecruit',
              'targetLocation' => ['source'],
            ]),
          )
        ],
      ],
    ];
  }
}
