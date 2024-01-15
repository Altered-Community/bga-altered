<?php
namespace ALT\Cards\YZ;

class YZ_Rare_RidetheBifrost extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_28_R2',
      'asset' => 'ALT_CORE_B_LY_28_R2',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Ride the Bifröst'),
      'typeline' => clienttranslate('Spell - Maneuver'),
      'type' => SPELL,
      'subtypes' => [MANEUVER],
      'effectDesc' => clienttranslate(
        '[[Fleeting]]. (Send me to Discard instead of Reserve after my effect resolves.)  All Characters you control switch Expeditions. (They leave their Expeditions and join their controller\'s other Expedition.)'
      ),
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
