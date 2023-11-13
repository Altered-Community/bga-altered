<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Common_SpyCraft extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

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
      'costReserve' => 2,
      'effectPlayed' => FT::SEQ(
        FT::GAIN($this, FLEETING),
        FT::ACTION(TARGET, [
          'targetType' => [CHARACTER, SPELL, PERMANENT],
          'targetLocation' => [RESERVE],
          'upTo' => true,
          'effect' => FT::ACTION(DISCARD, []),
        ]),
        FT::ACTION(RESUPPLY, [])
      ),
    ];
  }
}
