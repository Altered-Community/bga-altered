<?php
namespace ALT\Cards\MU;

class MU_Common_SpindleHarvesters extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '101',
      'asset' => 'ALT_CORE_B_MU_06_C_FRAMELESS_T1',
      'frameSize' => 1,

      'faction' => FACTION_MU,
      'name' => clienttranslate('Spindle Harvesters'),
      'type' => CHARACTER,
      'subtype' => 'Plant',
      'typeline' => 'Common - Plant',
      'rarity' => RARITY_COMMON,

      'effectDesc' => clienttranslate('{J} I become [[Anchored]].'),
      'reminders' => clienttranslate('(Anchored: At Night, I don\'t go to Reserve and I lose Anchored.)'),
      'forest' => 1,
      'mountain' => 0,
      'ocean' => 0,
      'costHand' => 1,
      'costMemory' => 1,
    ];
  }
}
