<?php
namespace ALT\Cards\BR;

class BR_Rare_Atlas extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_20_R1',
      'asset' => 'ALT_CORE_B_BR_20_R1',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Atlas'),
      'typeline' => clienttranslate('Character - Titan'),
      'type' => CHARACTER,
      'subtypes' => [TITAN],
      'effectDesc' => clienttranslate('$[GIGANTIC].  #$[SEASONED]#.'),
      'supportDesc' => clienttranslate(
        '#{D} : The next Character you play this turn gains 2 boosts.# (Discard me from Reserve to do this.)'
      ),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 5,
      'costReserve' => 5,
    ];
  }
}
