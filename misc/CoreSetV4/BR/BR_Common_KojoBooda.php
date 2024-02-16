<?php
namespace ALT\Cards\BR;

class BR_Common_KojoBooda extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_P_BR_01_C',
      'asset' => 'ALT_CORE_P_BR_01_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Kojo & Booda'),
      'typeline' => clienttranslate('Bravos Hero'),
      'type' => HERO,
      'flavorText' => clienttranslate('MISSING FLAVOR'),
      'artist' => 'MISSING ARTIST',
      'effectDesc' => clienttranslate(
        'At Noon, if you are the first player — Create a <BOODA> Companion token in your Companion Expedition.'
      ),
    ];
  }
}
