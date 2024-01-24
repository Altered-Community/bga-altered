<?php
namespace ALT\Cards\LY;

class LY_Rare_AllIn extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_25_R1',
      'asset' => 'ALT_CORE_B_LY_25_R1',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => 'All In!',
      'typeline' => 'Spell - Boon',
      'type' => SPELL,
      'flavorText' => "There's a time to be cautious, and a time to bet it all!",
      'artist' => 'HuoMiao Studio',
      'subtypes' => [BOON],
      'effectDesc' =>
        'Roll a die. #You may discard a card from your Reserve to increase the result by 2.# Target Character gains X boosts$[BB], where X is the final result.',
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
