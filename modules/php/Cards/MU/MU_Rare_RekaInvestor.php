<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_RekaInvestor extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_OR_92_R2',
      'asset'  => 'ALT_DUSTER_B_OR_92_R',

      'faction'  => FACTION_MU,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Reka Investor"),
      'typeline' => clienttranslate("Character - Bureaucrat Rogue"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"Trust me, it will all trickle down for everyone\'s benefit."'),
      'artist' => "Anh Tung",
      'extension' => 'SDU',
      'subtypes'  => [BUREAUCRAT, ROGUE],
      'effectDesc' => clienttranslate('At Dusk — Create a <MANASEED> token in your Landmarks.  #When I leave the Expedition zone — Create an <ORDIS_RECRUIT> Soldier token in my Expedition.#'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 0,
      'costHand' => 3,
      'costReserve' => 3,
      'effectPassive' => [
        'BeforeDusk' => [
          'conditions' => ['isMe'],
          'output' => FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'tokenType' => 'NE_Common_Manaseed',
            'targetLocation' => [LANDMARK],
          ]),
        ],
        'LeaveExpedition' => [
          'pId' => CONTROLLER,
          'output' => FT::ACTION(INVOKE_TOKEN, [
            'pId' => CONTROLLER,
            'tokenType' => 'OD_Common_OrdisRecruit',
            'targetLocation' => ['source'],
          ]),
        ],
      ]
    ];
  }
}
