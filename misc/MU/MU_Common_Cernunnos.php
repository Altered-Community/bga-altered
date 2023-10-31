<?php
namespace ALT\Cards\MU;

class MU_Common_Cernunnos extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '115',
      'asset' => 'MU-13-New-Cernunnos-C',

      'frameSize' => 1,

      'faction' => FACTION_MU,
      'name' => clienttranslate('Cernunnos'),
      'type' => CHARACTER,
      'subtype' => 'Druid',
      'typeline' => clienttranslate('Common - Druid'),
      'rarity' => RARITY_COMMON,

      'forest' => 4,
      'mountain' => 4,
      'ocean' => 3,
      'costHand' => 4,
      'costMemory' => 4,
    ];
  }
}
