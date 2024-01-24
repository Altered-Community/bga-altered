<?php
namespace ALT\Cards\YZ;

class YZ_Rare_KadigiranAlchemist extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_12_R1',
      'asset' => 'ALT_CORE_B_YZ_12_R1',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Kadigiran Alchemist'),
      'typeline' => clienttranslate('Character - Mage'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate(
        "Alchemy is not just a matter of turning lead to gold. It\'s about purifying yourself of imperfections to become your true self."
      ),
      'artist' => 'Edward Cheekokseang',
      'subtypes' => [MAGE],
      'effectDesc' => clienttranslate('{H} I gain #3 boosts$[BB]#.'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 3,
      'costReserve' => 1,
    ];
  }
}
