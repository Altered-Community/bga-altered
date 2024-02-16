<?php
namespace ALT\Cards\MU;

class MU_Common_Parvati extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_18_C',
      'asset' => 'ALT_CORE_B_MU_18_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => 'Parvati',
      'typeline' => 'Character - Deity',
      'type' => CHARACTER,
      'flavorText' => 'Only in harmony can the world thrive.',
      'artist' => 'Nestor Papatriantafyllou',
      'subtypes' => [DEITY],
      'effectDesc' => '{H} Target Character gains <ANCHORED>. (During Rest, it doesn\'t go to Reserve and it loses Anchored.)',
      'forest' => 3,
      'mountain' => 0,
      'ocean' => 3,
      'costHand' => 4,
      'costReserve' => 2,
    ];
  }
}
