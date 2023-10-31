<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Common_SpindleHarvesters extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '101',
      'asset' => 'MU-06-MusubiHarvester-C',
      'frameSize' => 1,

      'faction' => FACTION_MU,
      'name' => clienttranslate('Spindle Harvesters'),
      'typeline' => clienttranslate('Common - Plant'),
      'rarity' => RARITY_COMMON,
      'type' => CHARACTER,
      'subtype' => 'Plant',

      'effectDesc' => clienttranslate('{J} I become [[Anchored]].'),
      'reminders' => clienttranslate('(Anchored: At Night, I don\'t go to Reserve and I lose Anchored.)'),
      'forest' => 1,
      'mountain' => 0,
      'ocean' => 0,
      'costHand' => 1,
      'costMemory' => 1,
      'effectPlayed' => FT::GAIN($this, ANCHORED),
    ];
  }
}
