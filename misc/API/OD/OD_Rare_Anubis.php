<?php
namespace ALT\Cards\OD;

class OD_Rare_Anubis extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_20_R1',
      'asset' => 'ALT_CORE_B_OR_20_R1',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Anubis'),
      'typeline' => clienttranslate('Character - Deity'),
      'type' => CHARACTER,
      'subtypes' => [DEITY],
      'effectDesc' => clienttranslate('{J} Each player sacrifices a Character.'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 4,
      'costReserve' => 4,
    ];
  }
}
