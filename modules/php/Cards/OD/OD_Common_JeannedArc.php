<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Common_JeannedArc extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '145',
      'asset' => 'OD-17-JeanneD-Arc-C',
      'frameSize' => 1,

      'faction' => FACTION_OD,
      'name' => clienttranslate("Jeanne d'Arc"),
      'typeline' => clienttranslate('Common - Soldier'),
      'rarity' => RARITY_COMMON,
      'type' => CHARACTER,
      'subtype' => 'Soldier',

      'effectDesc' => clienttranslate(
        'When I leave the Expedition Zone - Create a [1/1/1 Ordis Recruit] Soldier token in both of your Expeditions.'
      ),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 4,
      'costMemory' => 4,
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
