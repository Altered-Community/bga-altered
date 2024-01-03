<?php
namespace ALT\Cards\MU;

class MU_Rare_SonofYggdrasil extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_21_R1',
      'asset' => 'ALT_CORE_B_MU_21_R1',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Son of Yggdrasil'),
      'typeline' => clienttranslate('Character - Plant'),
      'type' => CHARACTER,
      'subtypes' => [PLANT],
      'effectDesc' => clienttranslate(
        '[Gigantic]. (I am considered present in each of your Expeditions.)  [Tough 1]. (Your opponent\'s Spells and abilities that target me cost {1} more.)'
      ),
      'supportDesc' => clienttranslate(
        '{D} : Target Character with Hand Cost {3} or less gains [[Anchored]]. (Discard me from Reserve to do this.)'
      ),
      'forest' => 6,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 6,
      'costReserve' => 6,
    ];
  }
}
