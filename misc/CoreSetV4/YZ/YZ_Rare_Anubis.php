<?php
namespace ALT\Cards\YZ;

class YZ_Rare_Anubis extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_20_R2',
      'asset' => 'ALT_CORE_B_OR_20_R1',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => 'Anubis',
      'typeline' => 'Character - Deity',
      'type' => CHARACTER,
      'flavorText' => 'Only a heart as light as a feather can stand up to the judgment of Anubis.',
      'artist' => 'Romain Kurdi',
      'subtypes' => [DEITY],
      'effectDesc' => '{J} Each player sacrifices a Character.',
      'forest' => 3,
      'mountain' => 4,
      'ocean' => 3,
      'costHand' => 5,
      'costReserve' => 5,
    ];
  }
}
