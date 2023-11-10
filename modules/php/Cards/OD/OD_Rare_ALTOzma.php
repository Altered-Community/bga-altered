<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_ALTOzma extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '156',
      'asset' => 'OD-11-Ozma-R',
      'frameSize' => 1,

      'faction' => FACTION_OD,
      'name' => clienttranslate('ALT Ozma'),
      'type' => CHARACTER,
      'subtype' => 'Citizen',
      'typeline' => clienttranslate('Rare - Citizen'),
      'rarity' => RARITY_RARE,

      'effectDesc' => clienttranslate('{J} If you control at least 3 other Characters, draw a card.'),
      'echoDesc' => clienttranslate(
        '[G]{D} : The next Character you play this turn costs {1} less.[/G] (Discard me from your Reserve to activate this effect)'
      ),
      'changedStats' => ['forest', 'ocean'],
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costMemory' => 2,

      'effectPlayed' => FT::ACTION(CHECK_CONDITION, [
        'condition' => 'control3OtherCharacters',
        'effect' => FT::ACTION(DRAW, ['players' => ME]),
      ]),
      'effectEcho' => [
        'action' => SPECIAL_EFFECT,
        'args' => ['effect' => 'costReduction', 'args' => ['type' => CHARACTER, 'reduction' => 1]],
      ],
    ];
  }
}
