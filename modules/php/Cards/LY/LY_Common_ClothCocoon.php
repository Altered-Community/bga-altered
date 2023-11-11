<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;
class LY_Common_ClothCocoon extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '88',
      'asset' => 'LY-24-Cloth-Cocoon-C',
      'frameSize' => 1,

      'faction' => FACTION_LY,
      'name' => clienttranslate('Cloth Cocoon'),
      'typeline' => clienttranslate('Common'),
      'rarity' => RARITY_COMMON,
      'type' => SPELL,
      'subtype' => '',

      'effectDesc' => clienttranslate(
        '[[Fleeting]]. Choose one:  - Discard target [[Fleeting]], [[Anchored]] or [[Asleep]] Character.  - Discard target Permanent.'
      ),
      'reminders' => clienttranslate('(Fleeting: After my effect resolves, banish me.)'),
      'costHand' => 3,
      'costReserve' => 3,
      'effectPlayed' => FT::SEQ(
        FT::GAIN($this, FLEETING),
        FT::ACTION(TARGET, [
          'statuses' => [FLEETING, ANCHORED, ASLEEP],
          'targetType' => [CHARACTER, PERMANENT],
          'effect' => FT::ACTION(DISCARD, []),
        ])
      ),
    ];
  }
}
