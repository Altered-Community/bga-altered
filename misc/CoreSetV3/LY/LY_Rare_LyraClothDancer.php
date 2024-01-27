<?php
namespace ALT\Cards\LY;

class LY_Rare_LyraClothDancer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_14_R1',
      'asset' => 'ALT_CORE_B_LY_14_R1',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => 'Lyra Cloth Dancer',
      'typeline' => 'Character - Artist',
      'type' => CHARACTER,
      'flavorText' => 'Hope you\'re not afraid of heights!',
      'artist' => 'Fori Y.',
      'subtypes' => [ARTIST],
      'effectDesc' =>
        '{H} #Each Character controlled by target player# gains [FLEETING_CHAR]. (If it would be sent to Reserve, discard it instead.)',
      'forest' => 0,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 2,
      'changedStats' => ['mountain'],
    ];
  }
}
