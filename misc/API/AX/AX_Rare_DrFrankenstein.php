<?php
namespace ALT\Cards\AX;

class AX_Rare_DrFrankenstein extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_17_R1',
      'asset' => 'ALT_CORE_B_AX_17_R1',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Dr. Frankenstein'),
      'typeline' => clienttranslate('Character - Engineer'),
      'type' => CHARACTER,
      'subtypes' => [ENGINEER],
      'flavorText' => clienttranslate('We sometimes look for companionship in the strangest life forms.'),
      'effectDesc' => clienttranslate('{R} You may activate the {j} triggers of target Permanent you control.'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 4,
      'costReserve' => 2,
    ];
  }
}
