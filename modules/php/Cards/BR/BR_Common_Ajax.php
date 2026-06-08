<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Common_Ajax extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_FUGUE_B_BR_143_C',
      'asset' => 'ALT_FUGUE_B_BR_143_C',
      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Ajax'),
      'typeline' => clienttranslate('Character - Soldier'),
      'type' => CHARACTER,
      'artist' => 'DOBA',
      'extension' => 'NEJ',
      'subtypes' => [SOLDIER],
      'effectDesc' => clienttranslate('When I go to your Reserve from your Expeditions — You may play another Character from your Reserve for {2} less.'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 4,
      'costHand' => 4,
      'costReserve' => 3,
      'effectPassive' => [
        'LeaveExpedition' => [
          'pId' => CONTROLLER,
          'condition' => 'isToReserve',
          'output' => FT::ACTION(TARGET, [
              'targetLocation' => [RESERVE],
              'targetPlayer' => ME,
              'targetType' => [CHARACTER],
              'excludeSelf' => true,
              'effect' => FT::SEQ(
                FT::ACTION(SPECIAL_EFFECT, [
                  'effect' => 'costReduction',
                  'args' => ['type' => CHARACTER, 'reduction' => 2, 'permanent' => false],
                ]),
                FT::ACTION(PLAY_CARD, ['cardId' => EFFECT])
              ),
            ],
            ['optional' => true]
          ),
        ],
      ]
    ];
  }
}
