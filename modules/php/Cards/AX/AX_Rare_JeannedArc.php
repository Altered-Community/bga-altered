<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_JeannedArc extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_17_R2',
      'asset' => 'ALT_CORE_B_OR_17_R',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => "Jeanne d'Arc",
      'typeline' => clienttranslate('Character - Soldier'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate('She\'ll be followed long after she\'s gone.'),
      'artist' => 'Jean-Baptiste Andrier',
      'subtypes' => [SOLDIER],
      'effectDesc' => clienttranslate(
        'When I leave the Expedition zone — Create a #<BRASSBUG> Robot# token in each of your Expeditions.'
      ),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 5,
      'costReserve' => 5,
      'changedStats' => ['forest', 'mountain', 'ocean', 'costHand', 'costReserve'],
      'effectPassive' => [
        'LeaveExpedition' => [
          'pId' => CONTROLLER,
          'output' => FT::SEQ(
            FT::ACTION(INVOKE_TOKEN, [
              'pId' => CONTROLLER,
              'tokenType' => 'AX_Common_Brassbug',
              'targetLocation' => [STORM_RIGHT],
            ]),
            FT::ACTION(INVOKE_TOKEN, [
              'pId' => CONTROLLER,
              'tokenType' => 'AX_Common_Brassbug',
              'targetLocation' => [STORM_LEFT],
              'moreThan1' => true,
            ])
          ),
        ],
      ],
    ];
  }
}
