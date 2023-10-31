<?php
namespace ALT\Cards\AX;

class AX_Rare_TinkerBell extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '30',
      'asset' => 'AX-09-Tinkder-Bell-R',
      'frameSize' => 1,

      'faction' => FACTION_AX,
      'name' => clienttranslate('Tinker Bell'),
      'typeline' => clienttranslate('Rare - Fairy'),
      'rarity' => RARITY_RARE,
      'type' => CHARACTER,
      'subtype' => 'Fairy',

      'echoDesc' => clienttranslate(
        '[G]{D} : Activate the {J} effect of target Permanent.[/G] (Discard me from your Reserve to activate this effect)'
      ),
      'forest' => 3,
      'mountain' => 2,
      'ocean' => 0,
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}
