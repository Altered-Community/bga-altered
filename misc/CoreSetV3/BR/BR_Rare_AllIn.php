<?php
namespace ALT\Cards\BR;

class BR_Rare_AllIn extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_25_R2',
      'asset' => 'ALT_CORE_B_LY_25_R1',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => 'All In!',
      'typeline' => 'Spell - Boon',
      'type' => SPELL,
      'flavorText' => "There\'s a time to be cautious, and a time to bet it all!",
      'artist' => 'HuoMiao Studio',
      'subtypes' => [BOON],
      'effectDesc' => 'Roll a die. Target Character gains X boosts$[BB], where X is the result.',
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
