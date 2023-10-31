<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Base_Gretel extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'USA2023_BR_2_1_5',
      'asset' => 'BR-07-Gretel_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Gretel'),
      'type' => CHARACTER,
      'subtype' => 'Adventurer',
      'typeline' => 'Character Base - Adventurer',
      'rarity' => RARITY_BASE,
      'effectDesc' => clienttranslate(''),

      'forest' => 0,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 2,
      'costMemory' => 2,

      // // test
      // 'effectPassive' => [
      //   'Gain' => [
      //     'condition' => 'boostedByOtherCard',
      //     'output' => FT::GAIN($this, BOOST),
      //   ],
      // ],
    ];
  }
}
