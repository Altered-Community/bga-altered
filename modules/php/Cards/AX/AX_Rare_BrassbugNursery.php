<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_BrassbugNursery extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_AX_78_R1',
      'asset'  => 'ALT_CYCLONE_B_AX_78_R',

      'faction'  => FACTION_AX,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Brassbug Nursery"),
      'typeline' => clienttranslate("Landmark_permanent - Construction"),
      'type'  => PERMANENT,
      'flavorText'  => clienttranslate('Even far from their Hive, the Brassbugs have developed a way to continue reproducing.'),
      'artist' => "Justice Wong",
      'extension' => 'SO',
      'subtypes'  => [CONSTRUCTION, LANDMARK],
      'effectDesc' => clienttranslate('{T}, {1}, Sacrifice a Permanent: create a <BRASSBUG> Robot token in target Expedition.'),
      'costHand' => 3,
      'costReserve' => 3,
      'changedStats' => ['costHand', 'costReserve'],
      'effectTap' =>  FT::SEQ(
        FT::ACTION(PAY, ['pay' => 1]),
        FT::ACTION(TARGET, [
          'targetPlayer' => ME,
          'targetType' => [PERMANENT],
          'effect' => FT::SEQ(
            FT::ACTION(DISCARD, ['desc' => 'sacrifice']),
            FT::ACTION(INVOKE_TOKEN, [
              'pId' => 'source',
              'tokenType' => 'AX_Common_Brassbug',
              'targetLocation' => STORMS,
            ]),
          )
        ])
      )
    ];
  }
}
