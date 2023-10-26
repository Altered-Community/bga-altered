<?php
namespace ALT\Cards\OD;

class OD_Common_TheFrogPrince extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '135',
      'asset' => 'OR-09_FrogPrince_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_OR,
      'name' => clienttranslate('The Frog Prince'),
      'type' => CHARACTER,
      'subtype' => 'Bureaucrat',
      'typeline' => 'Common - Bureaucrat',
      'rarity' => RARITY_COMMON,

      'forest' => 3,
      'mountain' => 0,
      'ocean' => 3,
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}
