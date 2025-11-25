<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_FabLabUnit extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_AX_99_R2',
      'asset'  => 'ALT_DUSTER_B_AX_99_R',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Fab Lab Unit"),
      'typeline' => clienttranslate("Expedition Permanent - Gear"),
      'type'  => PERMANENT,
      'flavorText'  => clienttranslate('All the power of the Foundry distilled into this miracle of technology.'),
      'artist' => "Anh Tung",
      'extension' => 'SDU',
      'subtypes'  => [GEAR, EXPEDITION],
      'effectDesc' => clienttranslate('{T} : The next Character played from your hand in my Expedition this turn activates one of its {r} abilities.'),
      'costHand' => 2,
      'costReserve' => 1,
      'effectTap' => FT::ACTION(SPECIAL_EFFECT, [
        'effect' => 'triggerEffectOfNextCharacter',
        'args' => ['type' => CHARACTER, 'from' => HAND, 'effect' => RESERVE, 'to' => 'sourceLocation'],
      ]),
    ];
  }
}
