<?php
namespace ALT\Cards\YZ;

class YZ_Rare_CelestialBlast extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_27_R1',
      'asset' => 'ALT_CORE_B_YZ_27_R1',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Celestial Blast'),
      'typeline' => clienttranslate('Spell - Disruption'),
      'type' => SPELL,
      'subtypes' => [DISRUPTION],
      'effectDesc' => clienttranslate(
        '[[Fleeting]].  Discard up to two targets, Characters or Permanents. Draw a card. (Send me to Discard instead of Reserve after my effect resolves.)'
      ),
      'costHand' => 7,
      'costReserve' => 7,
    ];
  }
}
