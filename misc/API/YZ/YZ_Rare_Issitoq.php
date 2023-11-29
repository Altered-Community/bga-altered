<?php
namespace ALT\Cards\YZ;

class YZ_Rare_Issitoq extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_19_R2',
      'asset' => 'ALT_CORE_B_OR_19_R2',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Issitoq'),
      'typeline' => clienttranslate('Character - Bureaucrat Deity'),
      'type' => CHARACTER,
      'subtypes' => [BUREAUCRAT, DEITY],
      'effectDesc' => clienttranslate('Your other Expedition and the Expedition facing it can\'t move forward.'),
      'supportDesc' => clienttranslate('{D} : Draw a card. (Discard me from Reserve to do this.)'),
      'forest' => 4,
      'mountain' => 4,
      'ocean' => 4,
      'costHand' => 6,
      'costReserve' => 6,
    ];
  }
}
