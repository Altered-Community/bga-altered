<?php
namespace ALT\Cards\YZ;

class YZ_Rare_KadigiranMageDancer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_07_R1',
      'asset' => 'ALT_CORE_B_YZ_07_R1',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Kadigiran Mage-Dancer'),
      'typeline' => clienttranslate('Character - Mage Soldier'),
      'type' => CHARACTER,
      'subtypes' => [MAGE, SOLDIER],
      'effectDesc' => clienttranslate(
        'When you play a Spell — I gain 1 boost[]. (A boost is a +1/+1/+1 counter. Remove it when it leaves the Expedition zone.)  At Dusk, if I have 3 or more boosts — Draw a card.'
      ),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
