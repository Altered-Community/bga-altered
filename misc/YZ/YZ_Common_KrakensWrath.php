<?php
namespace ALT\Cards\YZ;

class YZ_Common_KrakensWrath extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '188',
      'asset' => 'YZ-04-StedfastDisciple-C',

      'frameSize' => 1,

      'faction' => FACTION_YZ,
      'name' => clienttranslate("Kraken's Wrath"),
      'typeline' => clienttranslate('Common'),
      'rarity' => RARITY_COMMON,
      'type' => SPELL,
      'subtype' => '',

      'effectDesc' => clienttranslate(
        '[[Fleeting]].  Send to Reserve up to 3 Characters with a cumulated hand cost of {5} or less.'
      ),
      'reminders' => clienttranslate('(Fleeting: After my effect resolves, banish me.)'),
      'costHand' => 5,
      'costMemory' => 5,
    ];
  }
}
