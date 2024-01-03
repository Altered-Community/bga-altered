<?php
namespace ALT\Cards\YZ;

class YZ_Rare_MeditationTraining extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_25_R2',
      'asset' => 'ALT_CORE_B_MU_25_R2',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Meditation Training'),
      'typeline' => clienttranslate('Spell - Boon'),
      'type' => SPELL,
      'subtypes' => [BOON],
      'effectDesc' => clienttranslate('Target Character with Hand Cost {3} or less gains $[ANCHORED].'),
      'costHand' => 2,
      'costReserve' => 3,
    ];
  }
}
