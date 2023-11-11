<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;
class OD_Common_StickyNotesSeals extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '150',
      'asset' => 'OD-33-Strength-in-Numbers-C',
      'frameSize' => 1,

      'faction' => FACTION_OD,
      'name' => clienttranslate('Sticky Notes Seals'),
      'typeline' => clienttranslate('Common'),
      'rarity' => RARITY_COMMON,
      'type' => SPELL,
      'subtype' => '',

      'effectDesc' => clienttranslate(
        '[[Fleeting]].  Choose one:  - Send to Reserve target Character of hand cost {4} or more.   - Discard target Permanent of hand cost {4} or more.'
      ),
      'reminders' => clienttranslate('(Fleeting: After my effect resolves, banish me.)'),
      'costHand' => 3,
      'costReserve' => 3,
      'effectPlayed' => FT::SEQ(
        FT::GAIN($this, FLEETING),
        FT::XOR(
          FT::ACTION(TARGET, ['minHandCost' => 4, 'effect' => FT::DISCARD_TO_RESERVE()]),
          FT::ACTION(TARGET, ['minHandCost' => 4, 'targetType' => [PERMANENT], 'effect' => FT::ACTION(DISCARD, [])])
        )
      ),
    ];
  }
}
