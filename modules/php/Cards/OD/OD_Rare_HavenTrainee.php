<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_HavenTrainee extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_09_R2',
      'asset' => 'ALT_CORE_B_BR_09_R',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Haven Trainee'),
      'typeline' => clienttranslate('Character - Apprentice'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate('"All right, lad, show me what you’ve learned."'),
      'artist' => 'Atanas Lozanski',
      'subtypes' => [APPRENTICE],
      'effectDesc' => clienttranslate('{R} #Create an <ORDIS_RECRUIT> Soldier token in each of your Expeditions.#'),
      'forest' => 3,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 4,
      'effectReserve' => FT::SEQ(
        FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'OD_Common_OrdisRecruit',
          'targetLocation' => [STORM_RIGHT],
        ]),
        FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'OD_Common_OrdisRecruit',
          'targetLocation' => [STORM_LEFT],
        ])
      ),
    ];
  }
}
