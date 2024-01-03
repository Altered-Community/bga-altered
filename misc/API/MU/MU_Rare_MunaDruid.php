<?php
namespace ALT\Cards\MU;

class MU_Rare_MunaDruid extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_13_R1',
      'asset' => 'ALT_CORE_B_MU_13_R1',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Muna Druid'),
      'typeline' => clienttranslate('Character - Druid'),
      'type' => CHARACTER,
      'subtypes' => [DRUID],
      'effectDesc' => clienttranslate(
        '{H} Up to one target Plant gains 2 boost[]s. (A boost is a +1/+1/+1 counter. Remove it when it leaves the Expedition zone.)'
      ),
      'supportDesc' => clienttranslate(
        '{D} : Target Character with Hand Cost {3} or less gains [[Anchored]]. (Discard me from Reserve to do this.)'
      ),
      'forest' => 2,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 3,
      'costReserve' => 2,
    ];
  }
}
