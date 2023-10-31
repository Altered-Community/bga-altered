<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Common_TeijaNauraa extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '97',
      'asset' => 'MU-02-Teija-Nauraa-C',
      'frameSize' => 1,

      'faction' => FACTION_MU,
      'name' => clienttranslate('Teija & Nauraa'),
      'typeline' => clienttranslate('Muna Hero'),
      'rarity' => RARITY_COMMON,
      'type' => HERO,
      'subtype' => '',

      'effectDesc' => clienttranslate('The first Character you play each day gains 1 boost.'),
      'effectPassive' => [
        'ChooseAssignment' => [
          'condition' => 'firstCharacterPlayed',
          'output' => FT::SEQ(FT::GAIN(EFFECT, BOOST), ['action' => SPECIAL_EFFECT, 'args' => ['effect' => 'useCard']]),
        ],
      ],
    ];
  }
}
