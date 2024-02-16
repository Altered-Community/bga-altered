<?php
namespace ALT\Cards\LY;

class LY_Rare_Esmeralda extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_11_R1',
      'asset' => 'ALT_CORE_B_LY_11_R1',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Esmeralda'),
      'typeline' => clienttranslate('Character - Artist'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate('Eidolon or not, you are our Shepherdess. You lead and we follow.'),
      'artist' => 'Edward Cheekokseang',
      'subtypes' => [ARTIST],
      'effectDesc' => clienttranslate('#{J}# $<RESUPPLY>.'),
      'forest' => 0,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 3,
      'changedStats' => ['costReserve'],
    ];
  }
}
