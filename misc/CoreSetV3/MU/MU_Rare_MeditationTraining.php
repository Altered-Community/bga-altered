<?php
namespace ALT\Cards\MU;

class MU_Rare_MeditationTraining extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_25_R1',
      'asset' => 'ALT_CORE_B_MU_25_R1',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Meditation Training'),
      'typeline' => clienttranslate('Spell - Boon'),
      'type' => SPELL,
      'flavorText' => clienttranslate("Don\'t think you are, know you are."),
      'artist' => 'HuoMiao Studio',
      'subtypes' => [BOON],
      'effectDesc' => clienttranslate(
        'Target Character with Hand Cost {3} or less gains [ANCHORED]. (During Rest, it doesn\'t go to Reserve and it loses Anchored.)'
      ),
      'supportDesc' => clienttranslate(
        '#{D} : The next Character you play this turn gains 1 boost.# (Discard me from Reserve to do this.)'
      ),
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['costReserve'],
    ];
  }
}
