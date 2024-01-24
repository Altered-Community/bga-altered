<?php
namespace ALT\Cards\YZ;

class YZ_Common_KuwattheDissenter extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_15_C',
      'asset' => 'ALT_CORE_B_YZ_15_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => 'Kuwat, the Dissenter',
      'typeline' => 'Character - Mage',
      'type' => CHARACTER,
      'flavorText' => "\"There are gates one should not open, there are seals one should not breach. And yet I will.\"",
      'artist' => 'Ba Vo',
      'subtypes' => [MAGE],
      'effectDesc' => '{J} Sacrifice a Character in my Expedition.',
      'forest' => 5,
      'mountain' => 5,
      'ocean' => 5,
      'costHand' => 4,
      'costReserve' => 4,
    ];
  }
}
