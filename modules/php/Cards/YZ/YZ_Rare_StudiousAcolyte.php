<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_StudiousAcolyte extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_YZ_68_R1',
      'asset'  => 'ALT_CYCLONE_B_YZ_68_R',

      'faction'  => FACTION_YZ,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Studious Acolyte"),
      'typeline' => clienttranslate("Character - Mage"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('Afanas\' backing is beginning to bear fruit.'),
      'artist' => "Tristan Bideau",
      'extension' => 'SO',
      'subtypes'  => [MAGE],
      'effectDesc' => clienttranslate('You may play Spells for #{2} less# if their Base Cost is #{7} or more.# (Reserve Cost if from Reserve, Hand Cost otherwise.)'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 1,
      'reduceCostType' => [SPELL => ['minBaseCost' => 7, 'reduction' => 2]]

    ];
  }
}
