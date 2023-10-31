<?php
namespace ALT\Cards\BR;

class BR_Common_Ratatoskr extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '37',
      'asset' => 'BR-04-Ratatoskr-C',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Ratatoskr'),
      'typeline' => clienttranslate('Common - Squirrel'),
      'rarity' => RARITY_COMMON,
      'type' => CHARACTER,
      'subtype' => 'Squirrel',

      'effectDesc' => clienttranslate('{S} I gain 2 boosts.'),
      'reminders' => clienttranslate('(Boosts are +1/+1/+1 counters that are removed when they leave the Expedition Zone.)'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 1,
      'costMemory' => 1,
      'effectMemory' => FT::GAIN($this, BOOST, 2),
    ];
  }
}
