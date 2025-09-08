<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_Beowulf extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_BR_76_R1',
      'asset'  => 'ALT_CYCLONE_B_BR_76_R',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Beowulf"),
      'typeline' => clienttranslate("Character - Adventurer"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"Each of us must suffer death; let he who is able cover himself in glory (before the end)!" - Beowulf'),
      'artist' => "Justice Wong",
      'extension' => 'SO',
      'subtypes'  => [ADVENTURER],
      'effectDesc' => clienttranslate('When I leave the Expedition zone — You may play a Character with #Base Cost {3} or less# for free. (Reserve Cost if from Reserve, Hand Cost otherwise.)'),
      'forest' => 5,
      'mountain' => 2,
      'ocean' => 5,
      'costHand' => 5,
      'costReserve' => 5,
      'effectPassive' => [
        'LeaveExpedition' => [
          'pId' => CONTROLLER,
          'output' => FT::ACTION(CHOOSE_ASSIGNMENT, ['actions' => ['play'], 'maxBaseCost' => 3, 'free' => true, 'types' => [CHARACTER]], ['optional' => true])
        ]
      ]
    ];
  }
}
