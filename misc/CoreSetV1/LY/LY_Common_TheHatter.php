<?php
namespace ALT\Cards\LY;

class LY_Common_TheHatter extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_18_C',
      'asset' => 'ALT_CORE_B_LY_18_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('The Hatter'),
      'type' => CHARACTER,
      'subtype' => CITIZEN,
      'effectDesc' => clienttranslate('(*He can\'t swim.*)  '),
      'supportDesc' => clienttranslate(
        '{D} : Target Character with hand cost {3} or less becomes [ANCHORED]. (Discard me from your Reserve to activate this effect)  '
      ),
      'forest' => 5,
      'mountain' => 5,
      'ocean' => 0,
      'costHand' => 4,
      'costMemory' => 4,
    ];
  }
}
