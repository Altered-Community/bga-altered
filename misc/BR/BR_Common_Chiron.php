<?php
namespace ALT\Cards\BR;

class BR_Common_Chiron extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '44',
      'asset' => 'BR-46_Chiron_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Chiron'),
      'type' => CHARACTER,
      'subtype' => 'Trainer',
      'typeline' => 'Common - Trainer',
      'rarity' => RARITY_COMMON,

      'effectDesc' => clienttranslate('{M} Target Character gains 1 boost.  {S} Target Character gains 2 boosts.'),
      'reminders' => clienttranslate('(Boosts are +1/+1/+1 counters that are removed when they leave the Expedition Zone.)'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}
