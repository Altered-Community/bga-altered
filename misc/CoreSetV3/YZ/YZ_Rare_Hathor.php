<?php
namespace ALT\Cards\YZ;

class YZ_Rare_Hathor extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_07_R2',
      'asset' => 'ALT_CORE_B_LY_07_R1',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => 'Hathor',
      'typeline' => 'Character - Artist Deity',
      'type' => CHARACTER,
      'flavorText' => 'Dance is the language of the soul.',
      'artist' => 'Taras Susak',
      'subtypes' => [ARTIST, DEITY],
      'supportDesc' => '{D} : Return another card from your Reserve to your hand. (Discard me from Reserve to do this.)',
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 0,
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['costReserve'],
    ];
  }
}
