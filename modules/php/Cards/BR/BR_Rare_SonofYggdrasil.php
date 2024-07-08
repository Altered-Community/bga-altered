<?php

namespace ALT\Cards\BR;

class BR_Rare_SonofYggdrasil extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_21_R2',
      'asset' => 'ALT_CORE_B_MU_21_R',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Son of Yggdrasil'),
      'typeline' => clienttranslate('Character - Plant'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate('World trees like the Spindle may have grown from the seeds of the Cosmic Ash.'),
      'artist' => 'Ba Vo',
      'subtypes' => [PLANT],
      'effectDesc' => clienttranslate('$<GIGANTIC>.'),
      'forest' => 6,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 6,
      'costReserve' => 6,
      'gigantic' => true,
    ];
  }
}
