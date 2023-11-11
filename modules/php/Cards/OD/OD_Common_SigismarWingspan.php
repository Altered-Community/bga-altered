<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Common_SigismarWingspan extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '128',
      'asset' => 'OD-02-Sigimar-Wingspan',
      'frameSize' => 1,

      'faction' => FACTION_OD,
      'name' => clienttranslate('Sigismar & Wingspan'),
      'typeline' => clienttranslate('Ordis Hero'),
      'rarity' => RARITY_COMMON,
      'type' => HERO,
      'subtype' => '',

      'reserveSlots' => 2,
      'permanentSlots' => 2,

      'effectDesc' => clienttranslate('At Dawn - Create a [1/1/1 Ordis Recruit] Soldier token in your Hero Expedition.'),
      'effectPassive' => [
        'Dawn' => [
          'condition' => 'myTurn',
          'output' => FT::ACTION(INVOKE_TOKEN, [
            'pId' => $this->getPId(),
            'tokenType' => 'OD_Common_OrdisRecruit',
            'targetLocation' => [STORM_LEFT],
          ]),
        ],
      ],
    ];
  }
}
