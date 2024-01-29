<?php
namespace ALT\Cards\AX;

class AX_Common_Boom extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_21_C',
      'asset' => 'ALT_CORE_B_AX_21_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => 'Boom!',
      'typeline' => 'Spell - Disruption',
      'type' => SPELL,
      'flavorText' => '"Catastrophic failure? I prefer the term \'learning opportunity\'."',
      'artist' => 'HuoMiao Studio',
      'subtypes' => [DISRUPTION],
      'effectDesc' => '$<FLEETING>.  Sacrifice a Character. If you do, discard target Character or Permanent.',
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
