<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Common_MeditationTraining extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '120',
      'asset' => 'MU-25-Mana-Web-C',

      'frameSize' => 1,

      'faction' => FACTION_MU,
      'name' => clienttranslate('Meditation Training'),
      'typeline' => clienttranslate('Common'),
      'rarity' => RARITY_COMMON,
      'type' => SPELL,
      'subtype' => '',

      'effectDesc' => clienttranslate('Target Character of hand cost {3} or less becomes [[Anchored]].'),
      'reminders' => clienttranslate('(Anchored: At Night, I don\'t go to Reserve and I lose Anchored.)'),
      'costHand' => 2,
      'costMemory' => 2,
      'effectPlayed' => FT::ACTION(TARGET, ['maxHandCost' => 3, 'effect' => FT::GAIN($this, ANCHORED)]),
    ];
  }
}
