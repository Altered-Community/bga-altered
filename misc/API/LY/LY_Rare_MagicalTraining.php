<?php
namespace ALT\Cards\LY;

class LY_Rare_MagicalTraining extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_19_R2',
      'asset' => 'ALT_CORE_B_YZ_19_R2',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Magical Training'),
      'typeline' => clienttranslate('Spell - Conjuration'),
      'type' => SPELL,
      'subtypes' => [CONJURATION],
      'effectDesc' => clienttranslate('Draw a card.'),
      'costHand' => 1,
      'costReserve' => 1,
    ];
  }
}
