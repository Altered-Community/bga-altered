<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Common_ConiferalConeman extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '118',
      'asset' => 'MU-20-ConiferalConeman-C',
      'frameSize' => 1,

      'faction' => FACTION_MU,
      'name' => clienttranslate('Coniferal Coneman'),
      'typeline' => clienttranslate('Common - Plant'),
      'rarity' => RARITY_COMMON,
      'type' => CHARACTER,
      'subtype' => 'Plant',

      'effectDesc' => clienttranslate('{J} I become [[Anchored]].'),
      'reminders' => clienttranslate('(Anchored: At Night, I don\'t go to Reserve and I lose Anchored.)'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 5,
      'costMemory' => 5,
      'effectPlayed' => FT::GAIN($this, ANCHORED),
    ];
  }
}
