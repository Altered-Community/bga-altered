<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Rare_FortheGreaterGood extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_YZ_117_R1',
      'asset'  => 'ALT_EOLE_B_YZ_117_R',

      'faction'  => FACTION_YZ,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("For the Greater Good"),
      'typeline' => clienttranslate("Spell - Disruption"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('Doing good sometimes requires sacrifices.'),
      'artist' => "Zero Wen",
      'extension' => 'ROC',
      'subtypes'  => [DISRUPTION],
      'effectDesc' => clienttranslate('<FLEETING>.  Discard a card from your hand. If you do, discard target card in play with Base Cost #{5} or less#.'),
      'costHand' => 2,
      'costReserve' => 2,
      'effectPlayed' => FT::SEQ(
        FT::GAIN(ME, FLEETING),
        FT::ACTION(TARGET, [
          'targetPlayer' => ME,
          'targetLocation' => [HAND],
          'targetType' => [CHARACTER, SPELL, PERMANENT],
          'effect' => FT::SEQ(
            FT::ACTION(DISCARD, []),
            FT::ACTION(TARGET, [
              'targetType' => [CHARACTER, SPELL, TOKEN, PERMANENT],
              'maxBaseCost' => 5,
              'effect' => FT::ACTION(DISCARD, []),
            ]),
          ),
        ]),
      ),
    ];
  }
}
