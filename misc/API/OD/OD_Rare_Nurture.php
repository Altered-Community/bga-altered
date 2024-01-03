<?php
namespace ALT\Cards\OD;

class OD_Rare_Nurture extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_27_R2',
      'asset' => 'ALT_CORE_B_MU_27_R2',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Nurture'),
      'typeline' => clienttranslate('Spell - Boon'),
      'type' => SPELL,
      'subtypes' => [BOON],
      'effectDesc' => clienttranslate(
        'Up to two target Characters each gain 1 boost[]. (A boost is a +1/+1/+1 counter. Remove it when it leaves the Expedition zone.)'
      ),
      'costHand' => 2,
      'costReserve' => 1,
    ];
  }
}
