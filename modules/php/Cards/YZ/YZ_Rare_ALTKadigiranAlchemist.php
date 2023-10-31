<?php
namespace ALT\Cards\YZ;

class YZ_Rare_ALTKadigiranAlchemist extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '195',
      'asset' => 'YZ-12-VanHelsing-R',
      'frameSize' => 1,

      'faction' => FACTION_YZ,
      'name' => clienttranslate('ALT Kadigiran Alchemist'),
      'typeline' => clienttranslate('Rare - Mage'),
      'rarity' => RARITY_RARE,
      'type' => CHARACTER,
      'subtype' => 'Mage',

      'effectDesc' => clienttranslate('{M} I gain [G]3[/G] boosts.'),
      'reminders' => clienttranslate('(Boosts are +1/+1/+1 counters that are removed when they leave the Expedition Zone.)'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 3,
      'costMemory' => 3,
    ];
  }
}
