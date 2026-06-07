<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_SpryScout extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_BR_109_R2',
      'asset'  => 'ALT_EOLE_B_BR_109_R',

      'faction'  => FACTION_OD,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Spry Scout"),
      'typeline' => clienttranslate("Character - Adventurer"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"Contact in sector 3. Try to outflank on the other side!"'),
      'artist' => "Kevin Sidharta",
      'extension' => 'ROC',
      'subtypes'  => [ADVENTURER],
      'effectDesc' => clienttranslate('{R} If you control a Feat, I gain 1 boost. #If it\'s <COMPLETED>, up to two target Characters each gain 1 boost instead.#'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
      'effectReserve' => FT::ACTION(CHECK_CONDITION, [
        'condition' => 'hasCompletedFeat:1',
        'effect' => FT::ACTION(TARGET, [
          'upTo' => true,
          'n' => 2,
          'effect' => FT::ACTION(GAIN, ['type' => BOOST]),
        ]),
        'oppositeEffect' => FT::ACTION(CHECK_CONDITION, [
          'condition' => 'hasControl:feat:1',
          'effect' => FT::GAIN(ME, BOOST),
        ]),
      ]),
    ];
  }
}
