<?php
namespace ALT\Cards\BR;

class BR_Rare_LadyoftheLake extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_09_R2',
      'asset' => 'ALT_CORE_B_YZ_09_R2',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Lady of the Lake'),
      'typeline' => clienttranslate('Character - Fairy Spirit'),
      'type' => CHARACTER,
      'subtypes' => [FAIRY, SPIRIT],
      'supportDesc' => clienttranslate(
        '#{D} : The next Character you play this turn loses [FLEETING].# (Discard me from Reserve to do this.)'
      ),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 3,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
