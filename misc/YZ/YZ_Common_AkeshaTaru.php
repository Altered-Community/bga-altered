<?php
namespace ALT\Cards\YZ;

class YZ_Common_AkeshaTaru extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '165',
      'asset' => 'YZ-01_Akesha-Kone_RGB',
      'frameSize' => 1,

      'faction' => FACTION_YZ,
      'name' => clienttranslate('Akesha & Taru'),
      'type' => HERO,
      'subtype' => 'Yzmir Hero',
      'typeline' => '',
      'rarity' => RARITY_COMMON,

      'effectDesc' => clienttranslate('{2}, {T} : [After you]. This ability costs {2} less if you have the first player Token'),
    ];
  }
}
