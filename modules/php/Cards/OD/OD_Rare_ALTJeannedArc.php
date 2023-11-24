<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_ALTJeannedArc extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_17_R1',
      'asset' => 'ALT_CORE_B_OR_17_R1',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate("ALT Jeanne d'Arc"),
      'type' => CHARACTER,
      'subtype' => SOLDIER,
      'effectDesc' => clienttranslate(
        'When I leave the Expedition zone — Create #two# [ORDIS_RECRUIT] Soldier tokens in both of your Expeditions.'
      ),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 5,
      'costReserve' => 5,
      'changedStats' => ['costHand', 'costReserve'],
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
