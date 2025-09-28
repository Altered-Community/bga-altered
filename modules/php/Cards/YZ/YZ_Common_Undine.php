<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Common_Undine extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_YZ_66_C',
      'asset'  => 'ALT_CYCLONE_B_YZ_66_C',

      'faction'  => FACTION_YZ,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Undine"),
      'typeline' => clienttranslate("Character - Elemental"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('When Yzmir alchemists call on the water spirit, the mischievous undine responds.'),
      'artist' => "Leena Sooba",
      'extension' => 'SO',
      'subtypes'  => [ELEMENTAL],
      'supportDesc' => clienttranslate('{D} : The next Spell you play this turn loses <FLEETING>. (Discard me from Reserve to do this.)'),
      'supportIcon' => 'discard',
      'forest' => 0,
      'mountain' => 0,
      'ocean' => 1,
      'costHand' => 1,
      'costReserve' => 1,
      'effectSupport' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'removeFleetingSpellPlayed']),
    ];
  }
}
