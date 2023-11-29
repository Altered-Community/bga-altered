<?php
namespace ALT\Cards\BR;

class BR_Rare_Kappa extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_13_R1',
      'asset' => 'ALT_CORE_B_BR_13_R1',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Kappa'),
      'typeline' => clienttranslate('Character - Spirit Trainer'),
      'type' => CHARACTER,
      'subtypes' => [SPIRIT, TRAINER],
      'effectDesc' => clienttranslate('[Seasoned]. (I keep my boosts when I go to Reserve.)'),
      'supportDesc' => clienttranslate(
        '{D} : The next Character you play this turn gains 1 boost. (Discard me from Reserve to do this.)'
      ),
      'forest' => 4,
      'mountain' => 4,
      'ocean' => 5,
      'costHand' => 4,
      'costReserve' => 4,
    ];
  }
}
