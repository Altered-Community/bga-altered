<?php
namespace ALT\Cards\YZ;

class YZ_Common_GiftofSelf extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_20_C',
      'asset' => 'ALT_CORE_B_YZ_20_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Gift of Self'),
      'typeline' => clienttranslate('Spell - Conjuration'),
      'type' => SPELL,
      'subtypes' => [CONJURATION],
      'effectDesc' => clienttranslate(
        '[[Fleeting]].  Sacrifice a Character to draw two cards. (Send me to Discard instead of Reserve after my effect resolves.)'
      ),
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
