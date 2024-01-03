<?php
namespace ALT\Cards\BR;

class BR_Rare_MindApotheosis extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_27_R2',
      'asset' => 'ALT_CORE_B_LY_27_R2',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Mind Apotheosis'),
      'typeline' => clienttranslate('Spell - Conjuration'),
      'type' => SPELL,
      'subtypes' => [CONJURATION],
      'effectDesc' => clienttranslate(
        '[[Fleeting]].  Reveal the top four cards of your Deck. Choose up to two Characters from these cards and put them in your Expeditions. They gain [[Fleeting]]. Discard the other cards. (Don\'t activate any {M} triggers.)'
      ),
      'costHand' => 9,
      'costReserve' => 9,
    ];
  }
}
