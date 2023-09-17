<?php
namespace ALT\Cards\BR;

class BR_Base_KojoandBooda extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'asset' => 'BR-01_Ekwu-Booda_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Kojo and Booda'),
      'type' => ALTERATEUR,
      'subtype' => 'Bravos Hero',
      'rarity' => RARITY_BASE,
    ];
  }
}
