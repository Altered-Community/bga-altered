<?php
namespace ALT\Cards\YZ;

class YZ_Rare_HuaMulan extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_12_R2',
      'asset' => 'ALT_CORE_B_BR_12_R1',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => 'Hua Mulan',
      'typeline' => 'Character - Adventurer',
      'type' => CHARACTER,
      'flavorText' => 'Her determination has yet to meet its match in this world.',
      'artist' => 'Zero Wen',
      'subtypes' => [ADVENTURER],
      'effectDesc' => '{R} I lose <FLEETING_CHAR>.',
      'forest' => 1,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['mountain', 'ocean', 'costHand', 'costReserve'],
    ];
  }
}
