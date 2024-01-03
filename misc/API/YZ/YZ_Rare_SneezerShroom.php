<?php
namespace ALT\Cards\YZ;

class YZ_Rare_SneezerShroom extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_08_R2',
      'asset' => 'ALT_CORE_B_MU_08_R2',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Sneezer Shroom'),
      'typeline' => clienttranslate('Character - Plant'),
      'type' => CHARACTER,
      'subtypes' => [PLANT],
      'effectDesc' => clienttranslate(
        '{J} I gain [[Anchored]]. (During Rest, I don\'t go to Reserve and I lose Anchored.)  At Noon — I gain 1 boost.'
      ),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
