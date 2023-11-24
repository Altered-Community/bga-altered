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
      'type' => HERO,
      'effectDesc' => clienttranslate(
        '{T}, discard a card from your Reserve : the next Character of hand cost {3} or less you play this turn becomes $[ANCHORED].'
      ),
    ];
  }
}
