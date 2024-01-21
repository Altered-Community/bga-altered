<?php
namespace ALT\Cards\MU;

class MU_Common_SonofYggdrasil extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_21_C',
      'asset' => 'ALT_CORE_B_MU_21_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => 'Son of Yggdrasil',
      'typeline' => 'Character - Plant',
      'type' => CHARACTER,
      'flavorText' => 'World trees like the Spindle may have grown from the seeds of the Cosmic Ash.',
      'artist' => 'Ba Vo',
      'subtypes' => [PLANT],
      'effectDesc' => '$[GIGANTIC].',
      'forest' => 6,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 6,
      'costReserve' => 6,
    ];
  }
}
