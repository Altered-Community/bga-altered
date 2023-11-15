<?php
namespace ALT\Cards\MU;

class MU_Common_YongSuVerdantWeaver extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_10_C',
      'asset' => 'ALT_CORE_B_MU_10_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Yong-Su, Verdant Weaver'),
      'type' => CHARACTER,
      'subtype' => GARDENER,
      'effectDesc' => clienttranslate('{J} If you have 2 or more Plants in your Expedition, I gain 2 boosts.  '),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 3,
      'costMemory' => 3,
    ];
  }
}
