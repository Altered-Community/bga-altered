<?php
namespace ALT\Cards\YZ;

class YZ_Common_SpyCraft extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '191',
      'asset' => 'YZ-22-UnjiriClairvoyant-C',
      'frameSize' => 1,

      'faction' => FACTION_YZ,
      'name' => clienttranslate('Spy Craft'),
      'typeline' => clienttranslate('Common'),
      'rarity' => RARITY_COMMON,
      'type' => SPELL,
      'subtype' => '',

      'effectDesc' => clienttranslate('[[Fleeting]].  [Sabotage], [Resupply].'),
      'reminders' => clienttranslate(
        '(Fleeting: After my effect resolves, banish me. Sabotage: Banish up to one target card from a Reserve. Resupply: Put the top card of your deck in your Reserve.)'
      ),
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}
