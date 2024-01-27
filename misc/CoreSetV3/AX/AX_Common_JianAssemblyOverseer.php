<?php
namespace ALT\Cards\AX;

class AX_Common_JianAssemblyOverseer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_10_C',
      'asset' => 'ALT_CORE_B_AX_10_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Jian, Assembly Overseer'),
      'typeline' => clienttranslate('Character - Engineer'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate(
        '"This material does not seem to be affected by gravity. By harnessing the properties of this Aerolith, we could create flying ships and cities, and fly close to the clouds..."'
      ),
      'artist' => 'Khoa Viet',
      'subtypes' => [ENGINEER],
      'forest' => 3,
      'mountain' => 2,
      'ocean' => 0,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
