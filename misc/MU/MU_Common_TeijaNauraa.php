<?php
namespace ALT\Cards\MU;

class MU_Common_TeijaNauraa extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '97',
      'asset' => 'MU-02-Teija-Nauraa-C',
      'frameSize' => 1,

      'faction' => FACTION_MU,
      'name' => clienttranslate('Teija & Nauraa'),
      'typeline' => clienttranslate('Muna Hero'),
      'rarity' => RARITY_COMMON,
      'type' => HERO,
      'subtype' => '',

      'effectDesc' => clienttranslate('The first Character you play each day gains 1 boost.'),
    ];
  }
}
