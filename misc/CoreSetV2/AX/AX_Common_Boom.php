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
      'name' => clienttranslate('Boom!'),
      'typeline' => clienttranslate('Spell - Disruption'),
      'type' => SPELL,
      'subtypes' => [DISRUPTION],
      'flavorText' => clienttranslate('Catastrophic failure ? I prefer the term \'learning opportunity\'.'),
      'effectDesc' => clienttranslate('$[FLEETING].  Sacrifice a Character. If you do, discard target Character or Permanent.'),
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
