<?php
namespace ALT\Cards\LY;

class LY_Common_LyraClothDancer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_14_C',
      'asset' => 'ALT_CORE_B_LY_14_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Lyra Cloth Dancer'),
      'typeline' => clienttranslate('Character - Artist'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate("Hope you\'re not afraid of heights!"),
      'artist' => 'Ting-Yun',
      'subtypes' => [ARTIST],
      'effectDesc' => clienttranslate(
        '{H} Up to one target Character gains [FLEETING_CHAR]. (If it would be sent to Reserve, discard it instead.)'
      ),
      'forest' => 0,
      'mountain' => 3,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 2,
    ];
  }
}
