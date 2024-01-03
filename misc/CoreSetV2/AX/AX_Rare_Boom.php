<?php
namespace ALT\Cards\AX;

class AX_Rare_Boom extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_21_R1',
      'asset' => 'ALT_CORE_B_AX_21_R1',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Boom!'),
      'typeline' => clienttranslate('Spell - Disruption'),
      'type' => SPELL,
      'subtypes' => [DISRUPTION],
      'flavorText' => clienttranslate('Catastrophic failure ? I prefer the term \'learning opportunity\'.'),
      'effectDesc' => clienttranslate(
        '$[FLEETING].  Sacrifice a Character #or Permanent#. If you do, discard target Character or Permanent.'
      ),
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
