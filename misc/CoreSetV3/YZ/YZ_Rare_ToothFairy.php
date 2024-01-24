<?php
namespace ALT\Cards\YZ;

class YZ_Rare_ToothFairy extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_06_R1',
      'asset' => 'ALT_CORE_B_YZ_06_R1',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Tooth Fairy'),
      'typeline' => clienttranslate('Character - Fairy'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate("\"Show me those pearly whites.\""),
      'artist' => 'Anh Tung',
      'subtypes' => [FAIRY],
      'effectDesc' => clienttranslate('{H} $[SABOTAGE].'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 1,
      'changedStats' => ['costReserve'],
    ];
  }
}
