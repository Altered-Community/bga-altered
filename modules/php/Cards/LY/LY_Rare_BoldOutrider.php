<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Rare_BoldOutrider extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_BR_112_R2',
      'asset'  => 'ALT_EOLE_B_BR_112_R',

      'faction'  => FACTION_LY,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Bold Outrider"),
      'typeline' => clienttranslate("Character - Adventurer"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"I\'ve found a way! A gap just two klicks away, straight ahead!"'),
      'artist' => "Fahmi Fauzi",
      'extension' => 'ROC',
      'subtypes'  => [ADVENTURER],
      'effectDesc' => clienttranslate('#{J} You may immediately play a Feat for {1} less, down to a minimum of {1}.#'),
      'supportDesc' => clienttranslate('#{D} : The next Character you play this turn gains 1 boost.#'),
      'supportIcon' => 'discard',
      'forest' => 3,
      'mountain' => 0,
      'ocean' => 3,
      'costHand' => 2,
      'costReserve' => 2,
      'effectPlayed' => FT::SEQ_OPTIONAL(
        [
          'action' => SPECIAL_EFFECT,
          'args' => ['effect' => 'costReduction', 'args' => ['type' => FEAT, 'reduction' => 1, 'minimum' => 1, 'permanent' => false]],
        ],
        FT::ACTION(CHOOSE_ASSIGNMENT, ['types' => [PERMANENT], 'subType' => FEAT, 'actions' => ['play']], ['optional' => true])
      ),
      'effectSupport' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'nextCharacterGains1Boost']),
    ];
  }
}
