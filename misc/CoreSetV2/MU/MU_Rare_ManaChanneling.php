<?php
namespace ALT\Cards\MU;

class MU_Rare_ManaChanneling extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_27_R2',
      'asset' => 'ALT_CORE_B_BR_27_R1',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Mana Channeling'),
      'typeline' => clienttranslate('Spell - Conjuration'),
      'type' => SPELL,
      'subtypes' => [CONJURATION],
      'effectDesc' => clienttranslate(
        '$[FLEETING].  Put the top card of your deck in your Mana zone (as an exhausted Mana Orb).'
      ),
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
