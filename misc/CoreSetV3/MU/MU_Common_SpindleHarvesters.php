<?php
namespace ALT\Cards\MU;

class MU_Common_SpindleHarvesters extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_06_C',
      'asset' => 'ALT_CORE_B_MU_06_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Spindle Harvesters'),
      'typeline' => clienttranslate('Character - Plant Animal'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate('Some say the harvesters are the caretakers of the world-trees.'),
      'artist' => 'Ba Vo',
      'subtypes' => [PLANT, ANIMAL],
      'effectDesc' => clienttranslate('{J} I gain $<ANCHORED>.'),
      'forest' => 1,
      'mountain' => 0,
      'ocean' => 0,
      'costHand' => 1,
      'costReserve' => 1,
    ];
  }
}
