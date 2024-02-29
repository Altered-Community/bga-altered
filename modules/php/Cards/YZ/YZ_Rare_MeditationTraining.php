<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;


class YZ_Rare_MeditationTraining extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_25_R2',
      'asset' => 'ALT_CORE_B_MU_25_R1',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => 'Meditation Training',
      'typeline' => 'Spell - Boon',
      'type' => SPELL,
      'flavorText' => 'Don\'t think you are, know you are.',
      'artist' => 'HuoMiao Studio',
      'subtypes' => [BOON],
      'effectDesc' =>
      'Target Character with Hand Cost {3} or less gains <ANCHORED>. (During Rest, it doesn\'t go to Reserve and it loses Anchored.)',
      'costHand' => 2,
      'costReserve' => 3,
      'effectPlayed' => FT::ACTION(TARGET, ['maxHandCost' => 3, 'effect' => FT::GAIN($this, ANCHORED)]),
    ];
  }
}
