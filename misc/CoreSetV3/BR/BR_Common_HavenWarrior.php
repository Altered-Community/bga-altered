<?php
namespace ALT\Cards\BR;

class BR_Common_HavenWarrior extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_17_C',
      'asset' => 'ALT_CORE_B_BR_17_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Haven Warrior'),
      'typeline' => clienttranslate('Character - Soldier'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate('We\'ve all lived through some things. But she\'s been through worse.'),
      'artist' => 'Edward Cheekokseang',
      'subtypes' => [SOLDIER],
      'forest' => 4,
      'mountain' => 2,
      'ocean' => 4,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
