<?php
namespace ALT\Cards\YZ;

class YZ_Rare_Sakarabru extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_18_R1',
      'asset' => 'ALT_CORE_B_YZ_18_R1',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Sakarabru'),
      'typeline' => clienttranslate('Character - Deity'),
      'type' => CHARACTER,
      'subtypes' => [DEITY],
      'effectDesc' => clienttranslate('{M} Your opponent\'s Expedition facing mine moves backwards one region.'),
      'supportDesc' => clienttranslate('{D} : Draw a card. (Discard me from Reserve to do this.)'),
      'forest' => 5,
      'mountain' => 5,
      'ocean' => 5,
      'costHand' => 7,
      'costReserve' => 7,
    ];
  }
}
