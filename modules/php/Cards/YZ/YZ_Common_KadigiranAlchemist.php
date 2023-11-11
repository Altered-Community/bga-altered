<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;
class YZ_Common_KadigiranAlchemist extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '175',
      'asset' => 'YZ-12-VanHelsing-C',
      'frameSize' => 1,

      'faction' => FACTION_YZ,
      'name' => clienttranslate('Kadigiran Alchemist'),
      'typeline' => clienttranslate('Common - Mage'),
      'rarity' => RARITY_COMMON,
      'type' => CHARACTER,
      'subtype' => 'Mage',

      'effectDesc' => clienttranslate('{M} I gain 2 boosts.'),
      'reminders' => clienttranslate('(Boosts are +1/+1/+1 counters that are removed when they leave the Expedition Zone.)'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 3,
      'costReserve' => 3,
      'effectHand' => FT::GAIN($this, BOOST, 2),
    ];
  }
}
