<?php
namespace ALT\Cards\MU;

class MU_Base_TeijaandNauraa extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'asset' => 'MU-02_Teija-Nauraa_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_MU,
      'name' => clienttranslate('Teija and Nauraa'),
      'type' => ALTERATEUR,
      'subtype' => 'Muna Hero',
      'rarity' => RARITY_BASE,
    ];
  }
}
