<?php
namespace ALT\Cards\BR;

class BR_Common_HuaMulan extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '47',
      'asset' => 'BR-36_Hua_Mulan_01',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Hua Mulan'),
      'type' => CHARACTER,
      'subtype' => 'Adventurer',
      'typeline' => 'Common - Adventurer',
      'rarity' => RARITY_COMMON,

      'effectDesc' => clienttranslate('{S} I gain 2 boosts.'),
      'reminders' => clienttranslate('(Boosts are +1/+1/+1 counters that are removed when they leave the Expedition Zone.)'),
      'forest' => 2,
      'mountain' => 4,
      'ocean' => 2,
      'costHand' => 3,
      'costMemory' => 3,
    ];
  }
}
