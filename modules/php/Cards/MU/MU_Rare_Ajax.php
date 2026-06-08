<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Rare_Ajax extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_FUGUE_B_BR_143_R2',
      'asset' => 'ALT_FUGUE_B_BR_143_R',
      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Ajax'),
      'typeline' => clienttranslate('Character - Soldier'),
      'type' => CHARACTER,
      'artist' => 'DOBA',
      'extension' => 'NEJ',
      'subtypes' => [SOLDIER],
      'effectDesc' => clienttranslate('When I #leave the Expedition zone# — You may play another Character from your Reserve for {2} less.'),
      'forest' => 4,
      'mountain' => 4,
      'ocean' => 4,
      'costHand' => 4,
      'costReserve' => 4,
      'changedStats' => ['forest', 'mountain', 'costReserve'],
      'effectPassive' => [
        'LeaveExpedition' => [
          'pId' => CONTROLLER,
          'output' => FT::ACTION(
            TARGET,
            [
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
