<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_Parvati extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_18_R2',
      'asset' => 'ALT_CORE_B_MU_18_R1',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => 'Parvati',
      'typeline' => 'Character - Deity',
      'type' => CHARACTER,
      'flavorText' => 'Only in harmony can the world thrive.',
      'artist' => 'Nestor Papatriantafyllou',
      'subtypes' => [DEITY],
      'effectDesc' => '#{J}# Target Character gains <ANCHORED>. (During Rest, it doesn\'t go to Reserve and it loses Anchored.)',
      'forest' => 3,
      'mountain' => 0,
      'ocean' => 3,
      'costHand' => 4,
      'costReserve' => 3,
      'changedStats' => ['costReserve'],
      'effectPlayed' => FT::ACTION(TARGET, ['effect' => FT::GAIN($this, ANCHORED)]),

    ];
  }
}
