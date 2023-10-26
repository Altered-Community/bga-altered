<?php
namespace ALT\Cards\OD;

class OD_Common_KakobaLegionCommander extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '143',
      'asset' => 'OR-26_Caellach_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_OR,
      'name' => clienttranslate('Kakoba, Legion Commander'),
      'type' => CHARACTER,
      'subtype' => 'Soldier',
      'typeline' => 'Common - Soldier',
      'rarity' => RARITY_COMMON,

      'effectDesc' => clienttranslate('{J} If you control at least 3 other Characters, I gain 2 boosts.'),
      'reminders' => clienttranslate('(Boosts are +1/+1/+1 counters that are removed when they leave the Expedition Zone.)'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costMemory' => 3,
    ];
  }
}
