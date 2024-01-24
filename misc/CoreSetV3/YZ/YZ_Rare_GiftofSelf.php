<?php
namespace ALT\Cards\YZ;

class YZ_Rare_GiftofSelf extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_20_R1',
      'asset' => 'ALT_CORE_B_YZ_20_R1',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => 'Gift of Self',
      'typeline' => 'Spell - Conjuration',
      'type' => SPELL,
      'flavorText' =>
        'Her being begins to disintegrate as she breaks all the Mana bridges linking the idea of who she is to physical matter.',
      'artist' => 'Fahmi Fauzi',
      'subtypes' => [CONJURATION],
      'effectDesc' => '$[FLEETING].  Sacrifice a Character. If you do, draw #three cards#.',
      'costHand' => 3,
      'costReserve' => 3,
      'changedStats' => ['costHand', 'costReserve'],
    ];
  }
}
