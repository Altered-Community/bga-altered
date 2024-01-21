<?php
namespace ALT\Cards\YZ;

class YZ_Common_GiftofSelf extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_20_C',
      'asset' => 'ALT_CORE_B_YZ_20_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => 'Gift of Self',
      'typeline' => 'Spell - Conjuration',
      'type' => SPELL,
      'flavorText' =>
        'Her being begins to disintegrate as she breaks all the Mana bridges linking the idea of who she is to physical matter.',
      'artist' => 'MISSING ARTIST',
      'subtypes' => [CONJURATION],
      'effectDesc' => '$[FLEETING].  Sacrifice a Character. If you do, draw two cards.',
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
