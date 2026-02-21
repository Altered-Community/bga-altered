<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_FrankensteinsCreature extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_AX_112_R2',
      'asset'  => 'ALT_EOLE_B_AX_112_R',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Frankenstein's Creature"),
      'typeline' => clienttranslate("Character - Robot"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate(''),
      'artist' => "Gamon Studio",
      'extension' => 'ROC',
      'subtypes'  => [ROBOT],
      'effectDesc' => clienttranslate('{R} You may target #a Feat# you control. It activates its {j} abilities.'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 0,
      'costHand' => 2,
      'costReserve' => 3,
      'changedStats' => ['costHand'],
      'effectReserve' => FT::ACTION(TARGET, [
        'targetType' => [PERMANENT],
        'targetPlayer' => ME,
        'targetSubtype' => FEAT,
        'upTo' => true,
        'maxBaseCost' => 2,
        'hasEffects' => ['Played'],
        'effect' => FT::ACTION(ACTIVATE_EFFECT, []),
      ]),
    ];
  }
}
