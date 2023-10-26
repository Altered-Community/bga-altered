<?php
namespace ALT\Cards\BR;

class BR_Common_Ratatoskr extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '37',
      'asset' => 'BR-38_Ratatoskr_01',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Ratatoskr'),
      'type' => CHARACTER,
      'subtype' => 'Squirrel',
      'typeline' => 'Common - Squirrel',
      'rarity' => RARITY_COMMON,

      'effectDesc' => clienttranslate('{S} I gain 2 boosts.'),
      'reminders' => clienttranslate('(Boosts are +1/+1/+1 counters that are removed when they leave the Expedition Zone.)'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 1,
      'costMemory' => 1,
    ];
  }
}
