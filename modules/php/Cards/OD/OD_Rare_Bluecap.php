<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_Bluecap extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_OR_69_R1',
      'asset'  => 'ALT_CYCLONE_B_OR_69_R',

      'faction'  => FACTION_OD,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Bluecap"),
      'typeline' => clienttranslate("Character - Bureaucrat"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('To avoid sudden jolts, invest in stone.'),
      'artist' => "Jean-Baptiste Andrier",
      'extension' => 'SO',
      'subtypes'  => [BUREAUCRAT],
      'effectDesc' => clienttranslate('When my Expedition fails to move forward during Dusk — Create an <AEROLITH> token in your Landmarks. #If both of your Expeditions failed to move forward, create two instead.#'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 3,
      'changedStats' => ['forest', 'mountain', 'ocean', 'costHand', 'costReserve'],
      'effectPassive' => [
        'AfterDusk' => [
          'condition' => 'myExpeditionHasNotMoved',
          'output' =>
          FT::XOR(
            FT::ACTION(CHECK_CONDITION, ['condition' => 'hasNotMoved', 'description' => clienttranslate('No move'), 'effect' => [
              'action' => INVOKE_TOKEN,
              'automatic' => true,
              'args' => ['tokenType' => 'NE_Common_Aerolith', 'n' => 2, 'targetLocation' => [LANDMARK]],
            ],]),
            FT::ACTION(CHECK_CONDITION, ['condition' => 'myOtherExpeditionHasMoved', 'description' => clienttranslate('Only 1 move'), 'effect' =>
            [
              'action' => INVOKE_TOKEN,
              'automatic' => true,
              'args' => ['tokenType' => 'NE_Common_Aerolith', 'targetLocation' => [LANDMARK]],
            ]])
          )
        ],
      ],
    ];
  }
}
