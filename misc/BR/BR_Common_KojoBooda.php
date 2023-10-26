<?php
namespace ALT\Cards\BR;

class BR_Common_KojoBooda extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '36',
      'asset' => 'BR-01_Ekwu-Booda_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Kojo & Booda'),
      'type' => HERO,
      'subtype' => 'Bravos Hero',
      'typeline' => '',
      'rarity' => RARITY_COMMON,

      'effectDesc' => clienttranslate(
        'At Dawn, if you have the first player�Token � Create a [Booda 2/2/2] Cat token in your Companion Expedition.'
      ),
    ];
  }
}
