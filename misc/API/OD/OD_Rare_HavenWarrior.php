<?php
namespace ALT\Cards\OD;

class OD_Rare_HavenWarrior extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_17_R2',
      'asset' => 'ALT_CORE_B_BR_17_R2',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Haven Warrior'),
      'typeline' => clienttranslate('Character - Soldier'),
      'type' => CHARACTER,
      'subtypes' => [SOLDIER],
      'supportDesc' => clienttranslate(
        '{D} : The next Character you play this turn gains 1 boost. (Discard me from Reserve to do this.)'
      ),
      'forest' => 4,
      'mountain' => 4,
      'ocean' => 4,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
