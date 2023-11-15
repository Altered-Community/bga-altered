<?php
namespace ALT\Cards\BR;

class BR_Common_AtsadiSurge extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_02_C',
      'asset' => 'ALT_CORE_B_BR_02_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Atsadi & Surge'),
      'type' => HERO,
      'effectDesc' => clienttranslate(
        'I begin the game with 5 Heroism Counters.  When you play a Character with hand cost equal to or higher than my number of Heroism Counters, draw a card and I gain a Heroism Counter.  '
      ),
    ];
  }
}
