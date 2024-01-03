<?php
namespace ALT\Cards\BR;

class BR_Common_KojoBooda extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_01_C',
      'asset' => 'ALT_CORE_B_BR_01_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Kojo & Booda'),
      'typeline' => clienttranslate('Hero'),
      'type' => HERO,
      'effectDesc' => clienttranslate(
        'At Noon, if you are first player — Create a [Booda 2/2/2] Companion token in the Companion Expedition.'
      ),
    ];
  }
}
