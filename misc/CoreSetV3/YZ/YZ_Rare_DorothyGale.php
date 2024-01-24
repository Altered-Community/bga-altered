<?php
namespace ALT\Cards\YZ;

class YZ_Rare_DorothyGale extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_16_R1',
      'asset' => 'ALT_CORE_B_YZ_16_R1',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Dorothy Gale'),
      'typeline' => clienttranslate('Character - Citizen'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate("\"I’ve a feeling we’re not in Kansas anymore.\""),
      'artist' => 'Taras Susak',
      'subtypes' => [CITIZEN],
      'effectDesc' => clienttranslate('#{J}# You may send target Character to Reserve.'),
      'forest' => 3,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 5,
      'costReserve' => 5,
      'changedStats' => ['costReserve'],
    ];
  }
}
