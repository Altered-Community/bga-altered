<?php
namespace ALT\Cards\AX;

class AX_Rare_OuroborosCroupier extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_17_R2',
      'asset' => 'ALT_CORE_B_LY_17_R1',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => 'Ouroboros Croupier',
      'typeline' => 'Character - Citizen',
      'type' => CHARACTER,
      'flavorText' => 'The house never loses.',
      'artist' => 'Anh Tung',
      'subtypes' => [CITIZEN],
      'effectDesc' => '{H} Roll a die. On a 4 or higher, draw a card. Otherwise, $[RESUPPLY].',
      'supportDesc' => '#{D} : The next card you play this turn costs {1} less.# (Discard me from Reserve to do this.)',
      'forest' => 0,
      'mountain' => 5,
      'ocean' => 5,
      'costHand' => 4,
      'costReserve' => 4,
      'changedStats' => ['mountain', 'ocean'],
    ];
  }
}
