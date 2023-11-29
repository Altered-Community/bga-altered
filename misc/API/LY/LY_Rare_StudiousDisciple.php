<?php
namespace ALT\Cards\LY;

class LY_Rare_StudiousDisciple extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_04_R2',
      'asset' => 'ALT_CORE_B_YZ_04_R2',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Studious Disciple'),
      'typeline' => clienttranslate('Character - Mage Apprentice'),
      'type' => CHARACTER,
      'subtypes' => [MAGE, APPRENTICE],
      'effectDesc' => clienttranslate('{S} The next Spell you play this Afternoon costs {1} less.'),
      'forest' => 0,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 1,
      'costReserve' => 1,
    ];
  }
}
