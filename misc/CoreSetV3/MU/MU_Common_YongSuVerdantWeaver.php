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
      'typeline' => clienttranslate('Character - Druid'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate('Green is good.'),
      'artist' => 'Kevin Sidharta',
      'subtypes' => [DRUID],
      'effectDesc' => clienttranslate(
        '{J} If you control two or more Plants, I gain 2 boosts$[BB]. (Cards in Reserve are not controlled.)'
      ),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
