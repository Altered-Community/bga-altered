<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Exalted_PlagueofDespair extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_LY_117_E',
      'asset'  => 'ALT_EOLE_B_LY_117_E',

      'faction'  => FACTION_LY,
      'rarity'  => RARITY_EXALTED,
      'name'  => clienttranslate("Plague of Despair"),
      'typeline' => clienttranslate("Character - Corruption"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"The soul does not give itself up to despair until it has exhausted all illusions." – Victor Hugo'),
      'artist' => "Taras Susak",
      'extension' => 'ROC',
      'subtypes'  => [CORRUPTION],
      'effectDesc' => clienttranslate('<GIGANTIC>.  When you roll a 6+ on a die — I gain 1 boost.  When you roll a 1 on a die — Send me to Reserve.'),
      'supportDesc' => clienttranslate('{D} : Target Character gains 1 boost.'),
      'supportIcon' => 'discard',
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 4,
      'costReserve' => 4,
      'gigantic' => true,
      'effectPassive' => [
        'RollDie' => [
          'childs' => [
            [
              'conditions' => ['isMe', 'isInStorms', 'selectedRoll:6:GTE'],
              'output' => FT::GAIN(ME, BOOST),
            ],
            [
              'conditions' => ['isMe', 'isInStorms', 'selectedRoll:1:EQ'],
              'output' => FT::ACTION(DISCARD, ['cardId' => ME, 'destination' => RESERVE]),
            ],
          ],
        ],
      ],
      'effectSupport' => FT::ACTION(TARGET, [
        'targetType' => [CHARACTER],
        'effect' => FT::GAIN(TARGET, BOOST),
      ]),
    ];
  }
}
