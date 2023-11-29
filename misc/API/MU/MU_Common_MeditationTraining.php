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
      'typeline' => clienttranslate('Spell - Boon'),
      'type' => SPELL,
      'subtypes' => [BOON],
      'effectDesc' => clienttranslate(
        'Target Character with Hand Cost {3} or less gains [[Anchored]]. (At Night, I don\'t go to Reserve and I lose Anchored.)'
      ),
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
