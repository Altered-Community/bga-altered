<?php
namespace ALT\Cards\YZ;

class YZ_Rare_ConjuringSeal extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_23_R1',
      'asset' => 'ALT_CORE_B_YZ_23_R1',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => 'Conjuring Seal',
      'typeline' => 'Spell - Conjuration',
      'type' => SPELL,
      'flavorText' => 'The Imagination shapes our reality just as our beliefs shaped the Æther.',
      'artist' => 'Khoa Viet',
      'subtypes' => [CONJURATION],
      'effectDesc' => 'Draw #three cards#.',
      'costHand' => 4,
      'costReserve' => 5,
      'changedStats' => ['costHand'],
    ];
  }
}
