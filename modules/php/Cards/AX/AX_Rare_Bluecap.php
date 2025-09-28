<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_Bluecap extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_OR_69_R2',
      'asset'  => 'ALT_CYCLONE_B_OR_69_R',

      'faction'  => FACTION_AX,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Bluecap"),
      'typeline' => clienttranslate("Character - Bureaucrat"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('To avoid sudden jolts, invest in stone.'),
      'artist' => "Jean-Baptiste Andrier",
      'extension' => 'SO',
      'subtypes'  => [BUREAUCRAT],
      'effectDesc' => clienttranslate('When my Expedition fails to move forward during Dusk — Create an <AEROLITH> token in your Landmarks.'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['ocean'],
      'effectPassive' => [
        'AfterDusk' => [
          'condition' => 'myExpeditionHasNotMoved',
          'output' => [
            'action' => INVOKE_TOKEN,
            'automatic' => true,
            'args' => ['tokenType' => 'NE_Common_Aerolith', 'targetLocation' => [LANDMARK]],
          ],
        ],
      ],
    ];
  }
}
