<?php
namespace ALT\Cards\LY;

class LY_Rare_LyraFestival extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_29_R1',
      'asset' => 'ALT_CORE_B_LY_29_R1',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Lyra Festival'),
      'typeline' => clienttranslate('Permanent - Landmark'),
      'type' => PERMANENT,
      'subtypes' => [LANDMARK],
      'effectDesc' => clienttranslate(
        '{J} Target Character gains [[Fleeting]], [[Anchored]] or [[Asleep]].  At Dusk — If you control a [[Fleeting]] Character, another [[Anchored]] Character and yet another [[Asleep]] Character, you win the game.'
      ),
      'costHand' => 4,
      'costReserve' => 4,
    ];
  }
}
