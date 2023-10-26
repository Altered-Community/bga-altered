<?php
namespace ALT\Cards\YZ;

class YZ_Common_OffYouGo extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '185',
      'asset' => 'YZ-30_Dottys_Tornado_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_YZ,
      'name' => clienttranslate('Off You Go!'),
      'type' => SPELL,
      'subtype' => '',
      'typeline' => 'Common - ',
      'rarity' => RARITY_COMMON,

      'effectDesc' => clienttranslate('Send to Reserve target Character of hand cost {3} or less.'),
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}
