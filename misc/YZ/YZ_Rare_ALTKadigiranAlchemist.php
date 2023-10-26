<?php
namespace ALT\Cards\YZ;

class YZ_Rare_ALTKadigiranAlchemist extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '195',
      'asset' => 'YZ-16_VanHelsing_RGB_02',
      'frameSize' => 1,

      'faction' => FACTION_YZ,
      'name' => clienttranslate('ALT Kadigiran Alchemist'),
      'type' => CHARACTER,
      'subtype' => 'Mage',
      'typeline' => 'Rare - Mage',
      'rarity' => RARITY_RARE,

      'effectDesc' => clienttranslate('{M} I gain <3> boosts.'),
      'reminders' => clienttranslate('(Boosts are +1/+1/+1 counters that are removed when they leave the Expedition Zone.)'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 3,
      'costMemory' => 3,
    ];
  }
}
