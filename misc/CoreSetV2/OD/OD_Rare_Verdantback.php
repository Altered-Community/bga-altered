<?php
namespace ALT\Cards\OD;

class OD_Rare_Verdantback extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_19_R2',
      'asset' => 'ALT_CORE_B_MU_19_R2',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Verdantback'),
      'typeline' => clienttranslate('Character - Plant Animal'),
      'type' => CHARACTER,
      'subtypes' => [PLANT, ANIMAL],
      'effectDesc' => clienttranslate('I have $[DEFENDER] unless you control two or more #Bureaucrats#.'),
      'forest' => 5,
      'mountain' => 5,
      'ocean' => 6,
      'costHand' => 4,
      'costReserve' => 4,
    ];
  }
}
