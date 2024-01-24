<?php
namespace ALT\Cards\YZ;

class YZ_Common_KadigiranAlchemist extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_12_C',
      'asset' => 'ALT_CORE_B_YZ_12_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Kadigiran Alchemist'),
      'typeline' => clienttranslate('Character - Mage'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate(
        "Alchemy is not just a matter of turning lead to gold. It's about purifying yourself of imperfections to become your true self."
      ),
      'artist' => 'Edward Cheekokseang',
      'subtypes' => [MAGE],
      'effectDesc' => clienttranslate('{H} I gain 2 boosts$[BB].'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 3,
      'costReserve' => 1,
    ];
  }
}
