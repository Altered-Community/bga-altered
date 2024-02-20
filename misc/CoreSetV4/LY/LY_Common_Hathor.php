<?php
namespace ALT\Cards\LY;

class LY_Common_Hathor extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_07_C',
      'asset' => 'ALT_CORE_B_LY_07_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Hathor'),
      'typeline' => clienttranslate('Character - Deity Artist'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate('Dance is the language of the soul.'),
      'artist' => 'Taras Susak',
      'subtypes' => [DEITY, ARTIST],
      'supportDesc' => clienttranslate(
        '{D} : Return another card from your Reserve to your hand. (Discard me from Reserve to do this.)'
      ),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 0,
      'costHand' => 2,
      'costReserve' => 3,
    ];
  }
}
