<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Common_DonJuan extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_LY_96_C',
      'asset'  => 'ALT_DUSTER_B_LY_96_C',

      'faction'  => FACTION_LY,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Don Juan"),
      'typeline' => clienttranslate("Character - Adventurer"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"Constancy is for insensitive clods alone."'),
      'artist' => "Justice Wong",
      'extension' => 'SDU',
      'subtypes'  => [ADVENTURER],
      'effectDesc' => clienttranslate('If I would go to Reserve from the Expedition zone, I gain <FLEETING> and defect instead. (I join the Expedition facing me, changing controllers. If I would go to any personal zone, I go to my owner\'s instead.)'),
      'forest' => 0,
      'mountain' => 5,
      'ocean' => 5,
      'costHand' => 3,
      'costReserve' => 4,
      'leaveExpeditionDefect' => true,
    ];
  }
}
