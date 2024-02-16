<?php
namespace ALT\Cards\MU;

class MU_Common_Cernunnos extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_14_C',
      'asset' => 'ALT_CORE_B_MU_14_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Cernunnos'),
      'typeline' => clienttranslate('Character - Deity Druid'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate('You can feel it in the trees, deep beneath their roots – the very heartbeat of nature.'),
      'artist' => 'Ba Vo',
      'subtypes' => [DEITY, DRUID],
      'forest' => 4,
      'mountain' => 4,
      'ocean' => 4,
      'costHand' => 4,
      'costReserve' => 3,
    ];
  }
}
