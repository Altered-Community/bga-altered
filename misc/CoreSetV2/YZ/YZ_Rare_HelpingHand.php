<?php
namespace ALT\Cards\YZ;

class YZ_Rare_HelpingHand extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_25_R2',
      'asset' => 'ALT_CORE_B_BR_25_R2',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Helping Hand'),
      'typeline' => clienttranslate('Spell - Boon'),
      'type' => SPELL,
      'subtypes' => [BOON],
      'effectDesc' => clienttranslate('Target Character gains 1 boost$[BB] and loses [FLEETING_CHAR].'),
      'costHand' => 1,
      'costReserve' => 2,
    ];
  }
}
