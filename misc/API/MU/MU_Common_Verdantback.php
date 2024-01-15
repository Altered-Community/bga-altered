<?php
namespace ALT\Cards\MU;

class MU_Common_Verdantback extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_19_C',
      'asset' => 'ALT_CORE_B_MU_19_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Verdantback'),
      'typeline' => clienttranslate('Character - ANIMAL'),
      'type' => CHARACTER,
      'subtypes' => [ANIMAL],
      'effectDesc' => clienttranslate(
        'I have [Defender] unless you control two or more other Plants. (My Expedition can\'t advance during Dusk.)'
      ),
      'forest' => 5,
      'mountain' => 5,
      'ocean' => 6,
      'costHand' => 4,
      'costReserve' => 4,
    ];
  }
}
