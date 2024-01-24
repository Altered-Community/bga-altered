<?php
namespace ALT\Cards\YZ;

class YZ_Rare_LyraSkald extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_08_R2',
      'asset' => 'ALT_CORE_B_LY_08_R1',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => 'Lyra Skald',
      'typeline' => 'Character - Artist',
      'type' => CHARACTER,
      'flavorText' => "We're all stories, in the end.",
      'artist' => 'Ba Vo',
      'subtypes' => [ARTIST],
      'effectDesc' => '#{H} You may discard a card from your Reserve to $[RESUPPLY].#',
      'supportDesc' => '#{D} : The next card you play this turn costs {1} less.# (Discard me from Reserve to do this.)',
      'forest' => 3,
      'mountain' => 0,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
