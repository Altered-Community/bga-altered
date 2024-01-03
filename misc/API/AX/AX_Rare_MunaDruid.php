<?php
namespace ALT\Cards\AX;

class AX_Rare_MunaDruid extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_13_R2',
      'asset' => 'ALT_CORE_B_MU_13_R2',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Muna Druid'),
      'typeline' => clienttranslate('Character - Druid'),
      'type' => CHARACTER,
      'subtypes' => [DRUID],
      'supportDesc' => clienttranslate(
        '{D} : Target Character with Hand Cost {3} or less gains [[Anchored]]. (Discard me from Reserve to do this.)'
      ),
      'forest' => 3,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 2,
    ];
  }
}
