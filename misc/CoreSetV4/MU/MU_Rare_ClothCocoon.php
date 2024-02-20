<?php
namespace ALT\Cards\MU;

class MU_Rare_ClothCocoon extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_24_R2',
      'asset' => 'ALT_CORE_B_LY_24_R1',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => 'Cloth Cocoon',
      'typeline' => 'Spell - Disruption',
      'type' => SPELL,
      'flavorText' => 'Nobody expects... the cloth dancer!',
      'artist' => 'Zero Wen',
      'subtypes' => [DISRUPTION],
      'effectDesc' =>
        '$<FLEETING>.  Choose one:  • Discard target <FLEETING_CHAR>, <ANCHORED> or <ASLEEP> Character.  • Discard target Permanent.',
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
