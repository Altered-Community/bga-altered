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
      'effectDesc' => clienttranslate(
        'Target Character gains 1 boost[] and loses [[Fleeting]]. (A boost is a +1/+1/+1 counter. Remove it when it leaves the Expedition zone.)'
      ),
      'costHand' => 1,
      'costReserve' => 2,
    ];
  }
}
