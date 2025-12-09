<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_DaughterofNaos extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_MU_92_R2',
      'asset'  => 'ALT_DUSTER_B_MU_92_R',

      'faction'  => FACTION_OD,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Daughter of Naos"),
      'typeline' => clienttranslate("Character - Plant"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('The torture of the Naos must cease.'),
      'artist' => "Khoa Viet",
      'extension' => 'SDU',
      'subtypes'  => [PLANT],
      'effectDesc' => clienttranslate('If I\'m <ANCHORED_FS>, I\'m <DEFENDER_FS>.  {J} I gain <ANCHORED>.'),
      'forest' => 2,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 3,
      'effectPlayed' => FT::GAIN(ME, ANCHORED),
      'dynamicDefender' => '1:isAnchored'
    ];
  }
}
