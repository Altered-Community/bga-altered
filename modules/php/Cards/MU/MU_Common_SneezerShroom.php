<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Common_SneezerShroom extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '104',
      'asset' => 'MU-08-Sneezer-Shroom-C',
      'frameSize' => 1,

      'faction' => FACTION_MU,
      'name' => clienttranslate('Sneezer Shroom'),
      'typeline' => clienttranslate('Common - Plant'),
      'rarity' => RARITY_COMMON,
      'type' => CHARACTER,
      'subtype' => 'Plant',

      'effectDesc' => clienttranslate('{J} I become [[Anchored]].'),
      'reminders' => clienttranslate('(Anchored: At Night, I don\'t go to Reserve and I lose Anchored.)'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 2,
      'effectPlayed' => FT::GAIN($this, ANCHORED),
    ];
  }
}
