<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_GuidingOcelot extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_BR_107_R1',
      'asset'  => 'ALT_EOLE_B_BR_107_R',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Guiding Ocelot"),
      'typeline' => clienttranslate("Character - Animal"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate(''),
      'artist' => "Julien Carrasco",
      'extension' => 'ROC',
      'subtypes'  => [ANIMAL],
      'effectDesc' => clienttranslate('{J} I gain #2 boosts.#  When another Character joins your Expeditions — You may spend 1 boost #from a Character you control# to give it 1 boost.'),
      'forest' => 0,
      'mountain' => 0,
      'ocean' => 0,
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['forest', 'mountain', 'ocean'],
    ];
  }
}
