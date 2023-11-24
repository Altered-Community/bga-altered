<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Common_DorothyGale extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_16_C',
      'asset' => 'ALT_CORE_B_YZ_16_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Dorothy Gale'),
      'type' => CHARACTER,
      'subtype' => CITIZEN,
      'effectDesc' => clienttranslate('{M} Send to Reserve target Character.'),
      'forest' => 3,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 5,
      'costReserve' => 5,
      'effectHand' => FT::ACTION(TARGET, ['effect' => FT::DISCARD_TO_RESERVE()]),
    ];
  }
}
