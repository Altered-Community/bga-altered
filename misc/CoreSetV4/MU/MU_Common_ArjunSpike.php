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
      'name' => 'Arjun & Spike',
      'typeline' => 'Muna Hero',
      'type' => HERO,
      'flavorText' => 'When you care for the earth, it let roots grow strong and resilient.',
      'artist' => 'Ba Vo',
      'effectDesc' =>
        '{T}, Discard a card from your Reserve: the next Character you play this turn with Hand Cost {3} or less gains <ANCHORED>. (During Rest, it doesn\'t go to Reserve and it loses Anchored.)',
    ];
  }
}
