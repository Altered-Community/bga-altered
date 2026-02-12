<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Common_MothcatcherWand extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_YZ_101_C',
      'asset'  => 'ALT_DUSTER_B_YZ_101_C',

      'faction'  => FACTION_YZ,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Mothcatcher Wand"),
      'typeline' => clienttranslate("Expedition Permanent - Gear"),
      'type'  => PERMANENT,
      'flavorText'  => clienttranslate('Moyo uses it to capture the essence of illusion.'),
      'artist' => "HuoMiao Studio",
      'extension' => 'SDU',
      'subtypes'  => [GEAR, EXPEDITION],
      'effectDesc' => clienttranslate('{J} Exhaust target card in Reserve.  {T}, {X} : Create X <MANA_MOTH> Illusion tokens in my Expedition. X can\'t be higher than the number of exhausted cards in Reserve.'),
      'costHand' => 2,
      'costReserve' => 2,
      'effectPlayed' => FT::ACTION(TARGET, [
        'targetLocation' => [RESERVE],
        'targetType' => [CHARACTER, SPELL, PERMANENT],
        'effect' => FT::ACTION(EXHAUST, [])
      ]),
      'effectTap' => FT::SEQ(
        FT::ACTION(PAY, ['pay' => 'X', 'maximum' => 'exhaustedReserve']),
        FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'YZ_Common_ManaMoth',
          'targetLocation' => ['source'],
          'n' => 'paidMana'
        ]),
      )

    ];
  }
}
