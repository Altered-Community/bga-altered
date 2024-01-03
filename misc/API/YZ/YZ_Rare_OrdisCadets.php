<?php
namespace ALT\Cards\YZ;

class YZ_Rare_OrdisCadets extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_06_R2',
      'asset' => 'ALT_CORE_B_OR_06_R2',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Ordis Cadets'),
      'typeline' => clienttranslate('Character - Apprentice Soldier'),
      'type' => CHARACTER,
      'subtypes' => [APPRENTICE, SOLDIER],
      'effectDesc' => clienttranslate('{J} Create an [Ordis Recruit 1/1/1] Soldier token in my Expedition.'),
      'supportDesc' => clienttranslate(
        '{D} : The next Spell you play this turn costs {1} less. (Discard me from Reserve to do this.)'
      ),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 0,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
