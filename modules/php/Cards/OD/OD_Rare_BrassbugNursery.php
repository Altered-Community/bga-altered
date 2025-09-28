<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_BrassbugNursery extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_AX_78_R2',
      'asset'  => 'ALT_CYCLONE_B_AX_78_R',

      'faction'  => FACTION_OD,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Brassbug Nursery"),
      'typeline' => clienttranslate("Landmark_permanent - Construction"),
      'type'  => PERMANENT,
      'flavorText'  => clienttranslate('Even far from their Hive, the Brassbugs have developed a way to continue reproducing.'),
      'artist' => "Justice Wong",
      'extension' => 'SO',
      'subtypes'  => [CONSTRUCTION, LANDMARK],
      'effectDesc' => clienttranslate('{J} Create an <AEROLITH> token in your Landmarks.  {T}, {1}, Sacrifice a Permanent: create a <BRASSBUG> Robot token in target Expedition.'),
      'costHand' => 4,
      'costReserve' => 4,
      'effectPlayed' => FT::ACTION(INVOKE_TOKEN, [
        'tokenType' => 'NE_Common_Aerolith',
        'targetLocation' => [LANDMARK],
      ]),
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
