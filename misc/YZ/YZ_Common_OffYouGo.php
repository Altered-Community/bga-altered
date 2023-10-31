<?php
namespace ALT\Cards\YZ;

class YZ_Common_OffYouGo extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '185',
      'asset' => 'YZ-21-Dottys-Tornado-C',
      'frameSize' => 1,

      'faction' => FACTION_YZ,
      'name' => clienttranslate('Off You Go!'),
      'typeline' => clienttranslate('Common'),
      'rarity' => RARITY_COMMON,
      'type' => SPELL,
      'subtype' => '',

      'effectDesc' => clienttranslate('Send to Reserve target Character of hand cost {3} or less.'),
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}
