<?php
namespace ALT\Cards\MU;

class MU_Common_MunaDruid extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '112',
      'asset' => 'MU-20_TasakaalMeshrider_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_MU,
      'name' => clienttranslate('Muna Druid'),
      'type' => CHARACTER,
      'subtype' => 'Druid',
      'typeline' => 'Common - Druid',
      'rarity' => RARITY_COMMON,

      'echoDesc' => clienttranslate(
        '{D} : Target Character with hand cost {3} or less becomes [[Anchored]]. (Discard me from your Reserve to activate this effect)'
      ),
      'forest' => 3,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costMemory' => 3,
    ];
  }
}
