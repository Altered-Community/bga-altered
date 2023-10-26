<?php
namespace ALT\Cards\YZ;

class YZ_Common_KadigiranAlchemist extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '175',
      'asset' => 'YZ-16_VanHelsing_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_YZ,
      'name' => clienttranslate('Kadigiran Alchemist'),
      'type' => CHARACTER,
      'subtype' => 'Mage',
      'typeline' => 'Common - Mage',
      'rarity' => RARITY_COMMON,

      'effectDesc' => clienttranslate('{M} I gain 2 boosts.'),
      'reminders' => clienttranslate('(Boosts are +1/+1/+1 counters that are removed when they leave the Expedition Zone.)'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 3,
      'costMemory' => 3,
    ];
  }
}
