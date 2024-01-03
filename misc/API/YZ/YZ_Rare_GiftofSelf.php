<?php
namespace ALT\Cards\YZ;

class YZ_Rare_GiftofSelf extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_20_R1',
      'asset' => 'ALT_CORE_B_YZ_20_R1',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Gift of Self'),
      'typeline' => clienttranslate('Spell - Conjuration'),
      'type' => SPELL,
      'subtypes' => [CONJURATION],
      'effectDesc' => clienttranslate(
        '[[Fleeting]]. (Send me to Discard instead of Reserve after my effect resolves.)  Sacrifice a Character to draw three cards.'
      ),
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
