<?php
namespace ALT\Cards\AX;

class AX_Common_AxiomScrambler extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_15_C',
      'asset' => 'ALT_CORE_B_AX_15_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Axiom Scrambler'),
      'typeline' => clienttranslate('Character - Engineer'),
      'type' => CHARACTER,
      'subtypes' => [ENGINEER],
      'flavorText' => clienttranslate(
        'Pushing back the Tumult sometimes prevents other Alterers from materializing their Eidolons. This is regrettable.'
      ),
      'effectDesc' => clienttranslate('{H} [Sabotage]. (Discard up to one target card from a Reserve.)'),
      'forest' => 2,
      'mountain' => 4,
      'ocean' => 2,
      'costHand' => 4,
      'costReserve' => 4,
    ];
  }
}
