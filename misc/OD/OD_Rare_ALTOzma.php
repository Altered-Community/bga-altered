<?php
namespace ALT\Cards\OD;

class OD_Rare_ALTOzma extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '156',
      'asset' => 'OR-37_Ozma_RGB_02',
      'frameSize' => 1,

      'faction' => FACTION_OR,
      'name' => clienttranslate('ALT Ozma'),
      'type' => CHARACTER,
      'subtype' => 'Citizen',
      'typeline' => 'Rare - Citizen',
      'rarity' => RARITY_RARE,

      'echoDesc' => clienttranslate(
        '<{D} : The next Character you play this turn costs {1} less.> (Discard me from your Reserve to activate this effect)'
      ),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}
