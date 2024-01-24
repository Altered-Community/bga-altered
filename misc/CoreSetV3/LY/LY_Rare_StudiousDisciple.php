<?php
namespace ALT\Cards\LY;

class LY_Rare_StudiousDisciple extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_04_R2',
      'asset' => 'ALT_CORE_B_YZ_04_R1',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => 'Studious Disciple',
      'typeline' => 'Character - Mage Apprentice',
      'type' => CHARACTER,
      'flavorText' => 'So far behind, and still so much to learn!',
      'artist' => 'Floriane Bodereau',
      'subtypes' => [MAGE, APPRENTICE],
      'effectDesc' => '#{R} The next Spell you play this Afternoon costs {1} less.#',
      'supportDesc' => '{D} : The next Spell you play this turn costs {1} less. (Discard me from Reserve to do this.)',
      'forest' => 0,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 1,
      'costReserve' => 1,
    ];
  }
}
