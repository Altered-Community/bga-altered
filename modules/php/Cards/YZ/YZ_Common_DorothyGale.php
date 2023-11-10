<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Common_DorothyGale extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '180',
      'asset' => 'YZ-16-DorotyGale-C',
      'frameSize' => 1,

      'faction' => FACTION_YZ,
      'name' => clienttranslate('Dorothy Gale'),
      'typeline' => clienttranslate('Common - Citizen'),
      'rarity' => RARITY_COMMON,
      'type' => CHARACTER,
      'subtype' => 'Citizen',

      'effectDesc' => clienttranslate('{M} Send to Reserve target Character.'),
      'forest' => 3,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 5,
      'costMemory' => 5,
      'effectHand' => FT::ACTION(TARGET, ['effect' => FT::DISCARD_TO_RESERVE()]),
    ];
  }
}
