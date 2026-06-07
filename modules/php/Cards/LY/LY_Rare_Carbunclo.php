<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Rare_Carbunclo extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_LY_112_R1',
      'asset'  => 'ALT_EOLE_B_LY_112_R',

      'faction'  => FACTION_LY,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Carbunclo"),
      'typeline' => clienttranslate("Character - Animal Spirit"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('Is that a ruby on its forehead or a burning lump of coal ?'),
      'artist' => "Zero Wen",
      'extension' => 'ROC',
      'subtypes'  => [ANIMAL, SPIRIT],
      'effectDesc' => clienttranslate('#{J}# If a card in your Expeditions or your Reserve has a {D} ability, <RESUPPLY_LOW>. (Put the top card of your deck in Reserve.)'),
      'forest' => 2,
      'mountain' => 0,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['mountain'],
      'effectHand' => FT::ACTION(CHECK_CONDITION, [
        'condition' => 'hasOtherSupportCardInReserveOrExpeditions',
        'effect' => FT::ACTION(RESUPPLY, [])
      ]),
    ];
  }
}
