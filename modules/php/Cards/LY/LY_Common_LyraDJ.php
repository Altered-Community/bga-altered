<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Common_LyraDJ extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_LY_97_C',
      'asset'  => 'ALT_DUSTER_B_LY_97_C',

      'faction'  => FACTION_LY,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Lyra DJ"),
      'typeline' => clienttranslate("Character - Artist"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('There\'s something a bit unusual about this set…'),
      'artist' => "Zero Wen",
      'extension' => 'SDU',
      'subtypes'  => [ARTIST],
      'effectDesc' => clienttranslate('You may play me for {2} less in an Expedition that\'s <IN_CONTACT>. (It\'s In Contact if there is another player\'s Expedition in its region.)'),
      'forest' => 6,
      'mountain' => 6,
      'ocean' => 6,
      'costHand' => 6,
      'costReserve' => 6,
      'playLimitation' => '-2Contact'
    ];
  }
}
