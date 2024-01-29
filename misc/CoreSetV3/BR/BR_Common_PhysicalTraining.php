<?php
namespace ALT\Cards\BR;

class BR_Common_PhysicalTraining extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_26_C',
      'asset' => 'ALT_CORE_B_BR_26_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Physical Training'),
      'typeline' => clienttranslate('Spell - Boon'),
      'type' => SPELL,
      'flavorText' => clienttranslate(
        '100 crunches, 100 push-ups, 100 squats, a 10-km run and a desire to prove yourself. Just your typical morning of Bravos training.'
      ),
      'artist' => 'Polar Engine',
      'subtypes' => [BOON],
      'effectDesc' => clienttranslate('Target Character gains 3 boosts$<BB>.'),
      'costHand' => 2,
      'costReserve' => 3,
    ];
  }
}
