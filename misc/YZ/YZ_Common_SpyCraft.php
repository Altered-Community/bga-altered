<?php
namespace ALT\Cards\YZ;

class YZ_Common_SpyCraft extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '191',
      'asset' => 'YZ-21_UnjiriClairvoyant_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_YZ,
      'name' => clienttranslate('Spy Craft'),
      'type' => SPELL,
      'subtype' => '',
      'typeline' => 'Common - ',
      'rarity' => RARITY_COMMON,

      'effectDesc' => clienttranslate('[[Fleeting]].  [Sabotage], [Resupply].'),
      'reminders' => clienttranslate(
        '(Fleeting: After my effect resolves, banish me. Sabotage: Banish up to one target card from a Reserve. Resupply: Put the top card of your deck in your Reserve.)'
      ),
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}
