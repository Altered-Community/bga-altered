<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_PajuAxiomPilot extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_AX_70_C',
      'asset'  => 'ALT_CYCLONE_B_AX_70_C',

      'faction'  => FACTION_AX,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Paju, Axiom Pilot"),
      'typeline' => clienttranslate("Character - Adventurer"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"Look, Paju. Wandering unknown skies was our dream, and now we\'ve achieved it." - Treyst'),
      'artist' => "Victor Canton",
      'extension' => 'SO',
      'subtypes'  => [ADVENTURER],
      'supportDesc' => clienttranslate('{D} : Create an <AEROLITH> token in target player\'s Landmarks. (Discard me from Reserve to do this.)'),
      'supportIcon' => 'discard',
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
      'effectSupport' =>  [
        'action' => INVOKE_TOKEN,
        'args' => ['tokenType' => 'NE_Common_Aerolith', 'targetLocation' => [LANDMARK], 'allPlayers' => true],
      ],
    ];
  }
}
