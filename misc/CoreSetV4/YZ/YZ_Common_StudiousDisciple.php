<?php
namespace ALT\Cards\YZ;

class YZ_Common_StudiousDisciple extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_04_C',
      'asset' => 'ALT_CORE_B_YZ_04_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Studious Disciple'),
      'typeline' => clienttranslate('Character - Apprentice Mage'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate('So far behind, and still so much to learn!'),
      'artist' => 'Floriane Bodereau',
      'subtypes' => [APPRENTICE, MAGE],
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
