<?php
namespace ALT\Cards\YZ;

class YZ_Rare_ALTSpyCraft extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '194',
      'asset' => 'YZ-22-UnjiriClairvoyant-R',
      'frameSize' => 1,

      'faction' => FACTION_YZ,
      'name' => clienttranslate('ALT Spy Craft'),
      'typeline' => clienttranslate('Rare'),
      'rarity' => RARITY_RARE,
      'type' => SPELL,
      'subtype' => '',

      'effectDesc' => clienttranslate('[Sabotage], [Resupply].'),
      'reminders' => clienttranslate('(Sabotage: Banish up to one target card from a Reserve.)'),
      'changedStats' => ['costReserve'],
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
