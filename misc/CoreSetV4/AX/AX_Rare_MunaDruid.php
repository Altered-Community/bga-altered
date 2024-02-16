<?php
namespace ALT\Cards\AX;

class AX_Rare_MunaDruid extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_13_R2',
      'asset' => 'ALT_CORE_B_MU_13_R1',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => 'Muna Druid',
      'typeline' => 'Character - Druid',
      'type' => CHARACTER,
      'flavorText' => '"We are the sentinels of the Skein, always keeping a finger on the pulse of nature."',
      'artist' => 'Ba Vo',
      'subtypes' => [DRUID],
      'supportDesc' =>
        '{D} : Target Character with Hand Cost {3} or less gains <ANCHORED>. (Discard me from Reserve to do this.)',
      'forest' => 3,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 2,
    ];
  }
}
