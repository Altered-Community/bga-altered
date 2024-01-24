<?php
namespace ALT\Cards\YZ;

class YZ_Rare_Boom extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_21_R2',
      'asset' => 'ALT_CORE_B_AX_21_R1',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => 'Boom!',
      'typeline' => 'Spell - Disruption',
      'type' => SPELL,
      'flavorText' => "\"Catastrophic failure? I prefer the term 'learning opportunity'.\"",
      'artist' => 'HuoMiao Studio',
      'subtypes' => [DISRUPTION],
      'effectDesc' => '$[FLEETING].  Sacrifice a Character. If you do, discard target Character or Permanent.',
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
