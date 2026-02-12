<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_MothcatcherWand extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_YZ_101_R2',
      'asset'  => 'ALT_DUSTER_B_YZ_101_R',

      'faction'  => FACTION_AX,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Mothcatcher Wand"),
      'typeline' => clienttranslate("Expedition Permanent - Gear"),
      'type'  => PERMANENT,
      'flavorText'  => clienttranslate('Moyo uses it to capture the essence of illusion.'),
      'artist' => "HuoMiao Studio",
      'extension' => 'SDU',
      'subtypes'  => [GEAR, EXPEDITION],
      'effectDesc' => clienttranslate('{J} Exhaust target card in Reserve.  {T}, {X} : Create X <MANA_MOTH> Illusion tokens in my Expedition. X can\'t be higher than the total number of exhausted cards in Reserve and #other exhausted Permanents you control.#'),
      'costHand' => 2,
      'costReserve' => 2,
      'effectPlayed' => FT::ACTION(TARGET, [
        'targetLocation' => [RESERVE],
        'targetType' => [CHARACTER, SPELL, PERMANENT],
        'effect' => FT::ACTION(EXHAUST, [])
      ]),
      'effectTap' => FT::SEQ(
        FT::ACTION(PAY, ['pay' => 'X', 'maximum' => 'exhaustedReserveAndPermanent']),
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
