<?php
namespace ALT\Cards\YZ;

class YZ_Rare_StudiousDisciple extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_04_R1',
      'asset' => 'ALT_CORE_B_YZ_04_R1',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Studious Disciple'),
      'typeline' => clienttranslate('Character - Mage Apprentice'),
      'type' => CHARACTER,
      'subtypes' => [MAGE, APPRENTICE],
      'effectDesc' => clienttranslate('#{R} The next Spell you play this Afternoon costs {1} less.#'),
      'supportDesc' => clienttranslate(
        '{D} : The next Spell you play this turn costs {1} less. (Discard me from Reserve to do this.)'
      ),
      'forest' => 0,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 1,
      'costReserve' => 1,
    ];
  }
}
