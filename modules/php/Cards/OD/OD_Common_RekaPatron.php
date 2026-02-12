<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Common_RekaPatron extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_OR_89_C',
      'asset'  => 'ALT_DUSTER_B_OR_89_C',

      'faction'  => FACTION_OD,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Reka Patron"),
      'typeline' => clienttranslate("Character - Bureaucrat Noble"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('Art\'s value is in the eye of the beholder.'),
      'artist' => "Nestor Papatriantafyllou",
      'extension' => 'SDU',
      'subtypes'  => [BUREAUCRAT, NOBLE],
      'effectDesc' => clienttranslate('When my Expedition fails to move forward during Dusk — Create a <MANASEED> token in your Landmarks. (It\'s a Permanent with \"{T}, Sacrifice me: Ready a Mana Orb.\")'),
      'forest' => 2,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 2,
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
