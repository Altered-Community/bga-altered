<?php

namespace ALT\Cards\YZ;

class YZ_Rare_Red extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_10_R2',
      'asset' => 'ALT_CORE_B_BR_10_R',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Red'),
      'typeline' => clienttranslate('Character - Adventurer'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate('Grandma would be proud.'),
      'artist' => 'Jean-Baptiste Andrier',
      'subtypes' => [ADVENTURER],
      'effectDesc' => clienttranslate('$<SEASONED_ME_FS>.'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
      'seasoned' => true,
    ];
  }
}
