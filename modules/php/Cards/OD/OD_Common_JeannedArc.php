<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Common_JeannedArc extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_17_C',
      'asset' => 'ALT_CORE_B_OR_17_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate("Jeanne d'Arc"),
      'type' => CHARACTER,
      'subtype' => [SOLDIER],
      'effectDesc' => clienttranslate(
        'When I leave the Expedition zone — Create a [ORDIS_RECRUIT] Soldier token in both of your Expeditions.'
      ),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 4,
      'costReserve' => 4,
      'effectPassive' => [
        'LeaveExpedition' => [
          'output' => FT::SEQ(
            FT::ACTION(INVOKE_TOKEN, [
              'pId' => $this->getPId(),
              'tokenType' => 'OD_Common_OrdisRecruit',
              'targetLocation' => [STORM_RIGHT],
            ]),
            FT::ACTION(INVOKE_TOKEN, [
              'pId' => $this->getPId(),
              'tokenType' => 'OD_Common_OrdisRecruit',
              'targetLocation' => [STORM_LEFT],
            ])
          ),
        ],
        'BeforeNight' => [
          'condition' => 'myTurn',
          'output' => FT::SEQ(
            FT::ACTION(INVOKE_TOKEN, [
              'pId' => $this->getPId(),
              'tokenType' => 'OD_Common_OrdisRecruit',
              'targetLocation' => [STORM_RIGHT],
            ]),
            FT::ACTION(INVOKE_TOKEN, [
              'pId' => $this->getPId(),
              'tokenType' => 'OD_Common_OrdisRecruit',
              'targetLocation' => [STORM_LEFT],
            ])
          ),
        ],
      ],
    ];
  }
}
