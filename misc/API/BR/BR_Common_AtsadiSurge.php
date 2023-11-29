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
      'typeline' => clienttranslate('Hero'),
      'type' => HERO,
      'effectDesc' => clienttranslate(
        'I begin the game with five Heroism counters.  When you play a Character with Hand Cost equal to or greater than my number of Heroism counters — Draw a card and I gain a Heroism counter.'
      ),
    ];
  }
}
