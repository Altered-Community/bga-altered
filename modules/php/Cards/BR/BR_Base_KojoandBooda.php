<?php
namespace ALT\Cards\BR;

class BR_Base_KojoandBooda extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => 'USA2023_BR_1_1_2',
      'asset' => 'BR-01_Ekwu-Booda_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Kojo and Booda'),
      'type' => ALTERATEUR,
      'subtype' => 'Bravos Hero',
      'typeline' => 'Bravos Hero',
      'rarity' => RARITY_BASE,
      'effectDesc' => clienttranslate(
        'At Dawn, if you are first player — Create a [Booda 2/2/2] Cat token in the Companion Expedition.'
      ),
      'memorySlots' => 2,
      'permanentSlots' => 2,
    ];
  }
}
