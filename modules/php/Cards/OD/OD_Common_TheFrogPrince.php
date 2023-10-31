<?php
namespace ALT\Cards\OD;

class OD_Common_TheFrogPrince extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '135',
      'asset' => 'OD-09-FrogPrince-C',
      'frameSize' => 1,

      'faction' => FACTION_OD,
      'name' => clienttranslate('The Frog Prince'),
      'typeline' => clienttranslate('Common - Bureaucrat'),
      'rarity' => RARITY_COMMON,
      'type' => CHARACTER,
      'subtype' => 'Bureaucrat',

      'forest' => 3,
      'mountain' => 0,
      'ocean' => 3,
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}
