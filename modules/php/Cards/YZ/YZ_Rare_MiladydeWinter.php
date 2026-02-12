<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_MiladydeWinter extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_YZ_90_R1',
      'asset'  => 'ALT_DUSTER_B_YZ_90_R',

      'faction'  => FACTION_YZ,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Milady de Winter"),
      'typeline' => clienttranslate("Character - Noble Rogue"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('There\'s something so delectable about nabbing someone else\'s assets.'),
      'artist' => "Zero Wen",
      'extension' => 'SDU',
      'subtypes'  => [NOBLE, ROGUE],
      'effectDesc' => clienttranslate('{H} Take control of target Permanent #with Base Cost {2} or less,# putting it in my Expedition if it\'s an Expedition Permanent. (If it would move to your Reserve or any other personal zone, it goes to its owner\'s instead.)'),
      'forest' => 2,
      'mountain' => 1,
      'ocean' => 2,
      'costHand' => 5,
      'costReserve' => 2,
      'changedStats' => ['costHand'],
      'effectHand' => FT::ACTION(TARGET, [
        'targetLocation' => IN_PLAY,
        'targetType' => [PERMANENT],
        'maxBaseCost' => 2,
        'effect' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'defect', 'args' => ['moveToMe' => true, 'takeControl' => true]])
      ])
    ];
  }
}
