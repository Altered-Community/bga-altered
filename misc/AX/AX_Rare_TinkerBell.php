<?php
namespace ALT\Cards\AX;

class AX_Rare_TinkerBell extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '30',
      'asset' => 'AX-18_Tinkder_Bell_RGB_02',
      'frameSize' => 1,

      'faction' => FACTION_AX,
      'name' => clienttranslate('Tinker Bell'),
      'type' => CHARACTER,
      'subtype' => 'Fairy',
      'typeline' => 'Rare - Fairy',
      'rarity' => RARITY_RARE,

      'echoDesc' => clienttranslate(
        '<{D} : Activate the {J} effect of target Permanent.> (Discard me from your Reserve to activate this effect)'
      ),
      'forest' => 3,
      'mountain' => 2,
      'ocean' => 0,
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}
