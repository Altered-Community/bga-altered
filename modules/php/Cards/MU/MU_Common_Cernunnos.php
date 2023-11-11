<?php
namespace ALT\Cards\MU;

class MU_Common_Cernunnos extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '115',
      'asset' => 'MU-14-New-Cernunnos-C',
      'frameSize' => 1,

      'faction' => FACTION_MU,
      'name' => clienttranslate('Cernunnos'),
      'typeline' => clienttranslate('Common - Druid'),
      'rarity' => RARITY_COMMON,
      'type' => CHARACTER,
      'subtype' => 'Druid',

      'forest' => 4,
      'mountain' => 4,
      'ocean' => 4,
      'costHand' => 4,
      'costReserve' => 4,
    ];
  }
}
