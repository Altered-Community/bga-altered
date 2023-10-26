<?php
namespace ALT\Cards\OD;

class OD_Rare_ALTKakobaLegionCommander extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '157',
      'asset' => 'OR-26_Caellach_RGB_02',
      'frameSize' => 1,

      'faction' => FACTION_OR,
      'name' => clienttranslate('ALT Kakoba, Legion Commander'),
      'type' => CHARACTER,
      'subtype' => 'Soldier',
      'typeline' => 'Rare - Soldier',
      'rarity' => RARITY_RARE,

      'effectDesc' => clienttranslate('{J} If you control at least 3 other Characters, I gain <3> boosts.'),
      'reminders' => clienttranslate('(Boosts are +1/+1/+1 counters that are removed when they leave the Expedition Zone.)'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costMemory' => 3,
    ];
  }
}
