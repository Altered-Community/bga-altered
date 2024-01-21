<?php
namespace ALT\Cards\LY;

class LY_Rare_OuroborosInkcaster extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_10_R1',
      'asset' => 'ALT_CORE_B_LY_10_R1',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => 'Ouroboros Inkcaster',
      'typeline' => 'Character - Artist',
      'type' => CHARACTER,
      'flavorText' => 'When luck joins in the game, cleverness scores double. ',
      'artist' => 'MISSING ARTIST',
      'subtypes' => [ARTIST],
      'effectDesc' =>
        'When I go to Reserve from the Expedition zone — You may return another card from your Reserve to your hand.',
      'supportDesc' => '#{D} : The next card you play this turn costs {1} less.# (Discard me from Reserve to do this.)',
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['forest', 'mountain', 'costHand', 'costReserve'],
    ];
  }
}
