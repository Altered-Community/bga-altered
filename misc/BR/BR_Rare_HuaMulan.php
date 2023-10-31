<?php
namespace ALT\Cards\BR;

class BR_Rare_HuaMulan extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '64',
      'asset' => 'BR-12-Hua-Mulan-R',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Hua Mulan'),
      'typeline' => clienttranslate('Rare - Adventurer'),
      'rarity' => RARITY_RARE,
      'type' => CHARACTER,
      'subtype' => 'Adventurer',

      'effectDesc' => clienttranslate('{S} I gain 2 boosts [G]and lose [[Fleeting]].[/G]'),
      'reminders' => clienttranslate('(Boosts are +1/+1/+1 counters that are removed when they leave the Expedition Zone.)'),
      'forest' => 2,
      'mountain' => 4,
      'ocean' => 2,
      'costHand' => 3,
      'costMemory' => 3,
      'effectMemory' => FT::SEQ([FT::GAIN($this, BOOST, 2), FT::LOOSE($this, FLEETING)]),
    ];
  }
}
