<?php
namespace ALT\Cards\BR;

class BR_Rare_HuaMulan extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '64',
      'asset' => 'BR-36_Hua_Mulan_02',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Hua Mulan'),
      'type' => CHARACTER,
      'subtype' => 'Adventurer',
      'typeline' => 'Rare - Adventurer',
      'rarity' => RARITY_RARE,

      'effectDesc' => clienttranslate('{S} I gain 2 boosts <and lose [[Fleeting]].>'),
      'reminders' => clienttranslate('(Boosts are +1/+1/+1 counters that are removed when they leave the Expedition Zone.)'),
      'forest' => 2,
      'mountain' => 4,
      'ocean' => 2,
      'costHand' => 3,
      'costMemory' => 3,
    ];
  }
}
