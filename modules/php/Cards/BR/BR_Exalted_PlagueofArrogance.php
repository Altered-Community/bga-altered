<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Exalted_PlagueofArrogance extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_BR_116_E',
      'asset'  => 'ALT_EOLE_B_BR_116_E',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_EXALTED,
      'name'  => clienttranslate("Plague of Arrogance"),
      'typeline' => clienttranslate("Character - Corruption"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('The only thing more dangerous than ignorance is arrogance.'),
      'artist' => "Taras Susak",
      'extension' => 'ROC',
      'subtypes'  => [CORRUPTION],
      'effectDesc' => clienttranslate('<GIGANTIC>.  {J} Sacrifice a Feat to choose one, or sacrifice a <COMPLETED> Feat to choose two:  • <SABOTAGE>.  • Send target Character to Reserve.  • I gain 2 boosts.'),
      'forest' => 4,
      'mountain' => 4,
      'ocean' => 3,
      'costHand' => 7,
      'costReserve' => 7,
      'gigantic' => true,
      'effectPlayed' => FT::ACTION(TARGET, [
        'targetPlayer' => ME,
        'targetType' => [PERMANENT],
        'targetLocation' => [LANDMARK],
        'subType' => FEAT,
        'n' => 1,
        'effect' => FT::ACTION(CHECK_CONDITION, [
          'condition' => 'isTargetFeatCompleted',
          'effect' => FT::SEQ(
            FT::ACTION(DISCARD, ['desc' => 'sacrifice']),
            [
              'type' => NODE_OR,
              'args' => ['n' => 2],
              'pId' => 'source',
              'childs' => [
                FT::SABOTAGE(),
                FT::ACTION(TARGET, ['targetType' => [CHARACTER, TOKEN], 'effect' => FT::DISCARD_TO_RESERVE()]),
                FT::GAIN(ME, BOOST, 2),
              ],
            ],
          ),
          'oppositeEffect' => FT::SEQ(
            FT::ACTION(DISCARD, ['desc' => 'sacrifice']),
            [
              'type' => NODE_OR,
              'args' => ['n' => 1],
              'pId' => 'source',
              'childs' => [
                FT::SABOTAGE(),
                FT::ACTION(TARGET, ['targetType' => [CHARACTER, TOKEN], 'effect' => FT::DISCARD_TO_RESERVE()]),
                FT::GAIN(ME, BOOST, 2),
              ],
            ],
          ),
        ]),
      ]),
    ];
  }
}
