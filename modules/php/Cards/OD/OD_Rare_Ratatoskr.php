<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_Ratatoskr extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_04_R2',
      'asset' => 'ALT_CORE_B_BR_04_R2',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Ratatoskr'),
      'typeline' => clienttranslate('Character - Messenger'),
      'type' => CHARACTER,
      'subtypes' => [MESSENGER],
      'effectDesc' => clienttranslate('{R} #Create two [ORDIS_RECRUIT] Soldier tokens in my Expedition.#'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 1,
      'costReserve' => 3,
      'effectReserve' =>  FT::SEQ(
        FT::ACTION(INVOKE_TOKEN, [
          'pId' => $this->getPId(),
          'tokenType' => 'OD_Common_OrdisRecruit',
          'targetLocation' => ['source'],
        ]),
        FT::ACTION(INVOKE_TOKEN, [
          'pId' => $this->getPId(),
          'tokenType' => 'OD_Common_OrdisRecruit',
          'targetLocation' => ['source'],
        ])
      )
    ];
  }
}
