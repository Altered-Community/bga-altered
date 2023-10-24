<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Rare_ExhilaratingDew extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'USA2023_MU_3_2_29',
      'asset' => 'MU-49_Nurturing_Watering_Can_RGB_02',
      'frameSize' => 1,

      'faction' => FACTION_MU,
      'name' => clienttranslate('Exhilarating Dew'),
      'type' => SPELL,
      'subtype' => '',
      'typeline' => 'Spell Rare',
      'rarity' => RARITY_RARE,
      'effectDesc' => clienttranslate('[[Fleeting]].  Up to two target Characters gain 2 boosts.'),

      'reminders' => clienttranslate('Fleeting: After my effect resolves, banish me.'),
      'costHand' => 2,
      'costMemory' => 2,
      'effectPlayed' => FT::SEQ(
        FT::GAIN($this, FLEETING),
        FT::ACTION(TARGET, ['upTo' => true, 'n' => 2, 'effect' => FT::ACTION(GAIN, ['type' => BOOST, 'n' => 2])])
      ),
    ];
  }
}
