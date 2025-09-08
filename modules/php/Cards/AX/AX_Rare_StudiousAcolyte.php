<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_StudiousAcolyte extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_YZ_68_R2',
      'asset'  => 'ALT_CYCLONE_B_YZ_68_R',

      'faction'  => FACTION_AX,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Studious Acolyte"),
      'typeline' => clienttranslate("Character - Mage"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('Afanas\' backing is beginning to bear fruit.'),
      'artist' => "Tristan Bideau",
      'extension' => 'SO',
      'subtypes'  => [MAGE],
      'effectDesc' => clienttranslate('You may play #Permanents# for {1} less if their Base Cost is {4} or more. (Reserve Cost if from Reserve, Hand Cost otherwise.)'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 1,
      'reduceCostType' => [PERMANENT => ['minBaseCost' => 4, 'reduction' => 1]]
    ];
  }
}
