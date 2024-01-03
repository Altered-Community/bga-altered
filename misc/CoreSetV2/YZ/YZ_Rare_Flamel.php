<?php
namespace ALT\Cards\YZ;

class YZ_Rare_Flamel extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_14_R1',
      'asset' => 'ALT_CORE_B_YZ_14_R1',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Flamel'),
      'typeline' => clienttranslate('Character - Scholar'),
      'type' => CHARACTER,
      'subtypes' => [SCHOLAR],
      'effectDesc' => clienttranslate('{H} #$[RESUPPLY].# Then, you may return a Spell from your Reserve to your hand.'),
      'supportDesc' => clienttranslate(
        '{D} : The next Spell you play this turn costs {1} less. (Discard me from Reserve to do this.)'
      ),
      'forest' => 4,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 4,
      'costReserve' => 3,
    ];
  }
}
