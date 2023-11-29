<?php
namespace ALT\Cards\YZ;

class YZ_Common_CelestialBlast extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_27_C',
      'asset' => 'ALT_CORE_B_YZ_27_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Celestial Blast'),
      'typeline' => clienttranslate('Spell - Disruption'),
      'type' => SPELL,
      'subtypes' => [DISRUPTION],
      'effectDesc' => clienttranslate(
        '[[Fleeting]].  Discard up to two targets, Characters or Permanents. (Send me to Discard instead of Reserve after my effect resolves.)'
      ),
      'costHand' => 7,
      'costReserve' => 7,
    ];
  }
}
