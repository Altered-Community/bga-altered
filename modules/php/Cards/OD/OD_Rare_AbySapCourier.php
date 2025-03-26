<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_AbySapCourier extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_BISE_B_AX_54_R2',
      'asset'  => 'ALT_BISE_B_AX_54_R',

      'faction'  => FACTION_OD,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Aby, Sap Courier"),
      'typeline' => clienttranslate("Character - Engineer Messenger"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('This wheel is the result of hours of mechanical training.'),
      'artist' => "Aaron Ming",
      'extension' => 'WFTM',
      'subtypes'  => [ENGINEER, MESSENGER],
      'effectDesc' => clienttranslate('#$<SCOUT_2> {2}.#  {J} <AUGMENT_IMP> #any number# of target cards in play or in Reserve. (If they have counters, they gain 1 more. This can\'t target Hero cards.)'),
      'forest' => 3,
      'mountain' => 2,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 3,
      'scout' => 2,
      'effectPlayed' => FT::ACTION(TARGET, [
        'targetType' => [CHARACTER, SPELL, PERMANENT],
        'targetLocation' => [STORM_LEFT, STORM_RIGHT, LANDMARK, RESERVE],
        'upTo' => true,
        'n' => INFTY,
        'augmentOnly' => true,
        'effect' => FT::AUGMENT($this)
      ]),
    ];
  }
}
