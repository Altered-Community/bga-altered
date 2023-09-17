<?php
namespace ALT\Cards\MU;

class MU_Base_ResilienceTraining extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'asset' => 'MU-35_Mana_Web_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_MU,
      'name' => clienttranslate('Resilience Training'),
      'type' => SPELL,
      'subtype' => '',
      'rarity' => RARITY_BASE,
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}
