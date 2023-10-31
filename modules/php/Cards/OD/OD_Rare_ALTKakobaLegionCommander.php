<?php
namespace ALT\Cards\OD;

class OD_Rare_ALTKakobaLegionCommander extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '157',
      'asset' => 'OD-15-Caellach-R',
      'frameSize' => 1,

      'faction' => FACTION_OD,
      'name' => clienttranslate('ALT Kakoba, Legion Commander'),
      'typeline' => clienttranslate('Rare - Soldier'),
      'rarity' => RARITY_RARE,
      'type' => CHARACTER,
      'subtype' => 'Soldier',

      'effectDesc' => clienttranslate('{J} If you control at least 3 other Characters, I gain [G]3[/G] boosts.'),
      'reminders' => clienttranslate('(Boosts are +1/+1/+1 counters that are removed when they leave the Expedition Zone.)'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costMemory' => 3,
    ];
  }
}
