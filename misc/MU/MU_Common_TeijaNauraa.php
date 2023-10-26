<?php
namespace ALT\Cards\MU;

class MU_Common_TeijaNauraa extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '97',
      'asset' => 'MU-02_Teija-Nauraa_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_MU,
      'name' => clienttranslate('Teija & Nauraa'),
      'type' => HERO,
      'subtype' => 'Muna Hero',
      'typeline' => '',
      'rarity' => RARITY_COMMON,

      'effectDesc' => clienttranslate('The first Character you play each day gains 1 boost.'),
    ];
  }
}
