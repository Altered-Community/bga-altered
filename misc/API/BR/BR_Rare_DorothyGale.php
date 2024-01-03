<?php
namespace ALT\Cards\BR;

class BR_Rare_DorothyGale extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_16_R2',
      'asset' => 'ALT_CORE_B_YZ_16_R2',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Dorothy Gale'),
      'typeline' => clienttranslate('Character - Citizen'),
      'type' => CHARACTER,
      'subtypes' => [CITIZEN],
      'effectDesc' => clienttranslate('{H} You may send target Character to Reserve.'),
      'forest' => 3,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 5,
      'costReserve' => 3,
    ];
  }
}
