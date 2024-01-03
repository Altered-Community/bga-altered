<?php
namespace ALT\Cards\BR;

class BR_Rare_HelpingHand extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_25_R1',
      'asset' => 'ALT_CORE_B_BR_25_R1',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Helping Hand'),
      'typeline' => clienttranslate('Spell - Boon'),
      'type' => SPELL,
      'subtypes' => [BOON],
      'effectDesc' => clienttranslate('#$[FLEETING].#  Target Character gains #2 boosts# and loses [FLEETING_CHAR].'),
      'costHand' => 1,
      'costReserve' => 1,
      'changedStats' => ['costReserve'],
    ];
  }
}
