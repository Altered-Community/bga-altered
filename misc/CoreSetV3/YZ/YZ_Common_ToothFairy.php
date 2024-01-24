<?php
namespace ALT\Cards\YZ;

class YZ_Common_ToothFairy extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_06_C',
      'asset' => 'ALT_CORE_B_YZ_06_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => 'Tooth Fairy',
      'typeline' => 'Character - Fairy',
      'type' => CHARACTER,
      'flavorText' => "\"Show me those pearly whites.\"",
      'artist' => 'Anh Tung',
      'subtypes' => [FAIRY],
      'effectDesc' => '{H} $[SABOTAGE].',
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
