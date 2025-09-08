<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Common_SuhaQorganOperative extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_YZ_70_C',
      'asset'  => 'ALT_CYCLONE_B_YZ_70_C',

      'faction'  => FACTION_YZ,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Suha, Qorgan Operative"),
      'typeline' => clienttranslate("Character - Bureaucrat Mage"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('By accepting the Qorgan\'s offer, Suha got to see what was down the rabbit hole.'),
      'artist' => "Tristan Bideau",
      'extension' => 'SO',
      'subtypes'  => [BUREAUCRAT, MAGE],
      'effectDesc' => clienttranslate('{H} I gain 1 boost, then <SABOTAGE_LOW>. (Discard up to one target card from a Reserve.)'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 0,
      'costHand' => 3,
      'costReserve' => 1,
      'effectHand' => FT::SEQ(
        FT::GAIN(ME, BOOST),
        FT::SABOTAGE()
      )
    ];
  }
}
