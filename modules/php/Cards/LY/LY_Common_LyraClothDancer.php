<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Common_LyraClothDancer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '77',
      'asset' => 'LY-14-Kasirga-Wind-Dancer-C',
      'frameSize' => 1,

      'faction' => FACTION_LY,
      'name' => clienttranslate('Lyra Cloth-Dancer'),
      'typeline' => clienttranslate('Common - Artist'),
      'rarity' => RARITY_COMMON,
      'type' => CHARACTER,
      'subtype' => 'Artist',

      'effectDesc' => clienttranslate('{M} Another target Character becomes [[Fleeting]].'),
      'reminders' => clienttranslate('(Fleeting: If I would be sent to Reserve, banish me instead.)'),
      'forest' => 0,
      'mountain' => 3,
      'ocean' => 2,
      'costHand' => 3,
      'costMemory' => 3,
      'effectHand' => FT::ACTION(TARGET, ['excludeSelf' => true, 'effect' => FT::GAIN(EFFECT, FLEETING)]),
    ];
  }
}
