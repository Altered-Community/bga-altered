<?php
namespace ALT\Cards\YZ;

class YZ_Rare_ALTSpyCraft extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '194',
      'asset' => 'YZ-21_UnjiriClairvoyant_RGB_02',
      'frameSize' => 1,

      'faction' => FACTION_YZ,
      'name' => clienttranslate('ALT Spy Craft'),
      'type' => SPELL,
      'subtype' => '',
      'typeline' => 'Rare - ',
      'rarity' => RARITY_RARE,

      'effectDesc' => clienttranslate('[Sabotage], [Resupply].'),
      'reminders' => clienttranslate('(Sabotage: Banish up to one target card from a Reserve.)'),
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}
