<?php
namespace ALT\Cards\MU;

class MU_Common_ArjunSpike extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_02_C',
      'asset' => 'ALT_CORE_B_MU_02_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Arjun & Spike'),
      'typeline' => clienttranslate('Hero'),
      'type' => HERO,
      'effectDesc' => clienttranslate(
        '{T}, Discard a card from your Reserve: the next Character with Hand Cost {3} or less you play this turn gains [[Anchored]]. (At Night, I don\'t go to Reserve and I lose Anchored.)'
      ),
    ];
  }
}
