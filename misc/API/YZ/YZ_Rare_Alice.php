<?php
namespace ALT\Cards\YZ;

class YZ_Rare_Alice extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_13_R1',
      'asset' => 'ALT_CORE_B_YZ_13_R1',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Alice'),
      'typeline' => clienttranslate('Character - Citizen'),
      'type' => CHARACTER,
      'subtypes' => [CITIZEN],
      'supportDesc' => clienttranslate('{D} : [After You]. (Discard me from Reserve to do this.)'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 4,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
