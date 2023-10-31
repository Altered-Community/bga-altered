<?php
namespace ALT\Cards\OD;

class OD_Common_KakobaLegionCommander extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '143',
      'asset' => 'OD-15-Caellach-C',

      'frameSize' => 1,

      'faction' => FACTION_OD,
      'name' => clienttranslate('Kakoba, Legion Commander'),
      'typeline' => clienttranslate('Common - Soldier'),
      'rarity' => RARITY_COMMON,
      'type' => CHARACTER,
      'subtype' => 'Soldier',

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
