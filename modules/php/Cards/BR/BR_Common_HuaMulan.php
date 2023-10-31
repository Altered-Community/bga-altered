<?php
namespace ALT\Cards\BR;

class BR_Common_HuaMulan extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '47',
      'asset' => 'BR-12-Hua-Mulan-C',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Hua Mulan'),
      'typeline' => clienttranslate('Common - Adventurer'),
      'rarity' => RARITY_COMMON,
      'type' => CHARACTER,
      'subtype' => 'Adventurer',

      'effectDesc' => clienttranslate('{S} I gain 2 boosts.'),
      'reminders' => clienttranslate('(Boosts are +1/+1/+1 counters that are removed when they leave the Expedition Zone.)'),
      'forest' => 2,
      'mountain' => 4,
      'ocean' => 2,
      'costHand' => 3,
      'costMemory' => 3,
      'effectMemory' => FT::GAIN($this, BOOST, 2),
    ];
  }
}
