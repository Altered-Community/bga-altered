<?php
namespace ALT\Cards\MU;

class MU_Base_MunaDruid extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'USA2023_MU_2_1_23',
      'asset' => 'MU-20_TasakaalMeshrider_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_MU,
      'name' => clienttranslate('Muna Druid'),
      'type' => EXPLORER,
      'subtype' => 'Druid',
      'typeline' => 'Explorer Base - Druid',
      'rarity' => RARITY_BASE,
      'effectDesc' => clienttranslate(''),
      'echoDesc' => clienttranslate(
        '{D} : Target Character with hand cost {3} or less gains [[Anchored]]. (Banish me from your Reserve to activate this effect)'
      ),

      'forest' => 3,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costMemory' => 3,
    ];
  }
}
