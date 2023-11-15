<?php
namespace ALT\Cards\MU;

class MU_Common_MeditationTraining extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_25_C',
      'asset' => 'ALT_CORE_B_MU_25_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Meditation Training'),
      'type' => SPELL,
      'subtype' => SUPPORT,
      'effectDesc' => clienttranslate('Target Character of hand cost {3} or less becomes $[ANCHORED].  '),
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}
