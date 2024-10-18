<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Common_LindiweMaw extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_02_C',
      'asset' => 'ALT_CORE_B_YZ_02_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Lindiwe & Maw'),
      'typeline' => clienttranslate('Yzmir Hero'),
      'type' => HERO,
      'thumbnail' => 1,
      'statData' => 18,
      'flavorText' => clienttranslate('To master magic, one must be willing to sacrifice.'),
      'artist' => 'Edward Cheekokseang',
      'effectDesc' => clienttranslate(
        '{T} : Create a [Maw 0/0/0] Companion token in your Companion Expedition with "When you sacrifice a Character — I gain 2 boosts". This action costs {1} more if you are not the first player.'
      ),
      'reserveSlots' => 2,
      'landmarkSlots' => 2,

      'effectTap' => FT::XOR(
        FT::ACTION(CHECK_CONDITION, [
          'conditions' => ['isNotFirstPlayer', 'canPay:1'],
          'effect' => FT::SEQ(
            FT::ACTION(PAY, ['pay' => 1]),
            FT::ACTION(INVOKE_TOKEN, ['tokenType' => 'YZ_Common_Maw', 'targetLocation' => [STORM_RIGHT]])
          ),
        ]),
        FT::ACTION(CHECK_CONDITION, [
          'condition' => 'isFirstPlayer',
          'effect' => FT::ACTION(INVOKE_TOKEN, ['tokenType' => 'YZ_Common_Maw', 'targetLocation' => [STORM_RIGHT]]),
        ])
      ),
    ];
  }
}
