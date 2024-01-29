<?php
namespace ALT\Cards\BR;

class BR_Rare_Ratatoskr extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_04_R1',
      'asset' => 'ALT_CORE_B_BR_04_R1',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Ratatoskr'),
      'typeline' => clienttranslate('Character - Messenger'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate('You’re nuts if you think you can keep up with this little one!'),
      'artist' => 'Gaga Zhou',
      'subtypes' => [MESSENGER],
      'effectDesc' => clienttranslate('{R} I gain #3 boosts$<BB>#.'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 1,
      'costReserve' => 3,
    ];
  }
}
