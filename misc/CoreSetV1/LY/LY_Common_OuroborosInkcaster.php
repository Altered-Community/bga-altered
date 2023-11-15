<?php
namespace ALT\Cards\LY;

class LY_Common_OuroborosInkcaster extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_12_C',
      'asset' => 'ALT_CORE_B_LY_12_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Ouroboros Inkcaster'),
      'type' => CHARACTER,
      'subtype' => ARTIST,
      'effectDesc' => clienttranslate(
        'When I go to Reserve from the Expedition zone — You may return another card in your Reserve to your hand.  '
      ),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 2,
      'costHand' => 3,
      'costMemory' => 3,
    ];
  }
}
