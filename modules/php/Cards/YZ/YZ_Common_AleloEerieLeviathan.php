<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Common_AleloEerieLeviathan extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_YZ_73_C',
      'asset'  => 'ALT_CYCLONE_B_YZ_73_C',

      'faction'  => FACTION_YZ,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Alelo, Eerie Leviathan"),
      'typeline' => clienttranslate("Character - Leviathan"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('We followed in its wake, believing it was a magical current.'),
      'artist' => "Matteo Spirito",
      'extension' => 'SO',
      'subtypes'  => [LEVIATHAN],
      'effectDesc' => clienttranslate('$<GIGANTIC>.  I\'m also considered a Spell, even when not in play. (Play me as a Character, but it counts as playing a Spell for other abilities.)'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 5,
      'costReserve' => 5,
      'gigantic' => true,
      'additionalType' => [SPELL]
    ];
  }
}
