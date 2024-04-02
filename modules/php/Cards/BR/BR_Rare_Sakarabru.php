<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_Sakarabru extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_18_R2',
      'asset' => 'ALT_CORE_B_YZ_18_R1',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => 'Sakarabru',
      'typeline' => 'Character - Deity',
      'type' => CHARACTER,
      'flavorText' => 'When such a terrifying being appears in your path, taking a step back is only natural.',
      'artist' => 'Gael Giudicelli',
      'subtypes' => [DEITY],
      'effectDesc' => '{H} Your opponent\'s Expedition facing mine moves backwards one region.',
      'forest' => 4,
      'mountain' => 4,
      'ocean' => 4,
      'costHand' => 7,
      'costReserve' => 4,
      'effectHand' => FT::ACTION(MOVE_EXPEDITION, ['n' => -1, 'expedition' => [EFFECT], 'pId' => OPPONENT]),
    ];
  }
}
