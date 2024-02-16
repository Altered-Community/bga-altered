<?php
namespace ALT\Cards\MU;

class MU_Rare_Kitsune extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_05_R1',
      'asset' => 'ALT_CORE_B_MU_05_R1',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => 'Kitsune',
      'typeline' => 'Character - Spirit',
      'type' => CHARACTER,
      'flavorText' => '"Want to play a game of headman-hunter-fox with me? I promise not to cheat!"',
      'artist' => 'Gaga Zhou',
      'subtypes' => [SPIRIT],
      'effectDesc' => '{H} Each player #may <RESUPPLY_INF>.# (Put the top card of their deck in Reserve.)',
      'forest' => 0,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['ocean'],
    ];
  }
}
