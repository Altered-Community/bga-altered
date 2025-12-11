<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_RekaPatron extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_OR_89_R2',
      'asset'  => 'ALT_DUSTER_B_OR_89_R',

      'faction'  => FACTION_YZ,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Reka Patron"),
      'typeline' => clienttranslate("Character - Bureaucrat Noble"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('Art\'s value is in the eye of the beholder.'),
      'artist' => "Nestor Papatriantafyllou",
      'extension' => 'SDU',
      'subtypes'  => [BUREAUCRAT, NOBLE],
      'effectDesc' => clienttranslate('When my Expedition fails to move forward during Dusk — Create a <MANASEED> token in your Landmarks. '),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['mountain', 'ocean'],
      'effectPassive' => [
        'AfterDusk' => [
          'condition' => 'myExpeditionHasNotMoved',
          'output' => [
            'action' => INVOKE_TOKEN,
            'automatic' => true,
            'args' => ['tokenType' => 'NE_Common_Manaseed', 'targetLocation' => [LANDMARK]],
          ],
        ],
      ],
    ];
  }
}
