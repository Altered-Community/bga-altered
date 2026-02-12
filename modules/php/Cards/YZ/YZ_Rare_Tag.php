<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_Tag extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_YZ_99_R1',
      'asset'  => 'ALT_DUSTER_B_YZ_99_R',

      'faction'  => FACTION_YZ,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Tag!"),
      'typeline' => clienttranslate("Spell - Disruption Maneuver"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('"The Reka player is out!"'),
      'artist' => "Justice Wong",
      'extension' => 'SDU',
      'subtypes'  => [DISRUPTION, MANEUVER],
      'effectDesc' => clienttranslate('Target opponent sacrifices the Character #or Permanent# they control with the highest Base Cost. (Its Base Cost is the Reserve Cost if Fleeting, or the Hand Cost if not.)'),
      'supportDesc' => clienttranslate('#{D} : <AFTER_YOU>.#'),
      'supportIcon' => 'discard',
      'costHand' => 4,
      'costReserve' => 7,
      'changedStats' => ['costReserve'],
      'effectPlayed' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'sacrificeHighestCharacterPermanent']),
      'effectSupport' => FT::ACTION(AFTER_YOU, []),
    ];
  }
}
