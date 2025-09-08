<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Common_StudiousAcolyte extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_YZ_68_C',
      'asset'  => 'ALT_CYCLONE_B_YZ_68_C',

      'faction'  => FACTION_YZ,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Studious Acolyte"),
      'typeline' => clienttranslate("Character - Mage"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('Afanas\' backing is beginning to bear fruit.'),
      'artist' => "Tristan Bideau",
      'extension' => 'SO',
      'subtypes'  => [MAGE],
      'effectDesc' => clienttranslate('You may play Spells for {1} less if their Base Cost is {4} or more. (Reserve Cost if from Reserve, Hand Cost otherwise.)'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 1,
      'reduceCostType' => [SPELL => ['minBaseCost' => 4, 'reduction' => 1]]

    ];
  }
}
