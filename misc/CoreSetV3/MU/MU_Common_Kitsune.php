<?php
namespace ALT\Cards\MU;

class MU_Common_Kitsune extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_05_C',
      'asset' => 'ALT_CORE_B_MU_05_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Kitsune'),
      'typeline' => clienttranslate('Character - Spirit'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate('"Want to play a game of headman-hunter-fox with me? I promise not to cheat!"'),
      'artist' => 'Gaga Zhou',
      'subtypes' => [SPIRIT],
      'effectDesc' => clienttranslate('{H} Each player draws a card.'),
      'forest' => 0,
      'mountain' => 3,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
