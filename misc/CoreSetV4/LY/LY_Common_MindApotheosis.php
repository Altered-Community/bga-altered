<?php
namespace ALT\Cards\LY;

class LY_Common_MindApotheosis extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_27_C',
      'asset' => 'ALT_CORE_B_LY_27_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => 'Mind Apotheosis',
      'typeline' => 'Spell - Conjuration',
      'type' => SPELL,
      'flavorText' => 'Who looks outside, dreams; who looks inside, awakes.',
      'artist' => 'Zero Wen',
      'subtypes' => [CONJURATION],
      'effectDesc' =>
        '$<FLEETING>.  Reveal the top four cards of your Deck. Choose up to two Characters from these cards and put them in your Expeditions. They gain <FLEETING>. Discard the other cards. (Don\'t activate any {h} triggers.)',
      'costHand' => 9,
      'costReserve' => 9,
    ];
  }
}
