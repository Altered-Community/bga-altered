<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Common_NevenkaBlotch extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '68',
      'asset' => 'LY-03-Nevenka-Blotch',
      'frameSize' => 1,

      'faction' => FACTION_LY,
      'name' => clienttranslate('Nevenka & Blotch'),
      'typeline' => clienttranslate('Lyra Hero'),
      'rarity' => RARITY_COMMON,
      'type' => HERO,
      'subtype' => '',

      'memorySlots' => 2,
      'permanentSlots' => 2,

      'effectDesc' => clienttranslate(
        '{T} : Target an allied Character, then roll a die.  - On 6, it becomes [[Anchored]].  - On 1, send it to Reserve.  - Otherwise, it gains 1 boost.'
      ),
      'effectTap' => FT::ACTION(TARGET, [
        'targetPlayer' => ME,
        'effect' => FT::ACTION(ROLL_DIE, [
          'effect' => [
            '1' => FT::DISCARD_TO_RESERVE(),
            '2-5' => FT::GAIN(EFFECT, BOOST),
            '6' => FT::GAIN(EFFECT, ANCHORED),
          ],
        ]),
      ]),
    ];
  }
}
