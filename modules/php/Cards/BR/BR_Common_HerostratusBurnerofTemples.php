<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Common_HerostratusBurnerofTemples extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_FUGUE_B_BR_137_C',
      'asset' => 'ALT_FUGUE_B_BR_137_C',
      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Herostratus, Burner of Temples'),
      'typeline' => clienttranslate('Character - Soldier'),
      'type' => CHARACTER,
      'artist' => 'Gamon Studio',
      'extension' => 'NEJ',
      'subtypes' => [SOLDIER],
      'effectDesc' => clienttranslate('{R} You may discard one of your Mana Orbs to discard target Permanent with Base Cost {3} or less.'),
      'forest' => 3,
      'mountain' => 1,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 3,
      'effectReserve' =>  FT::SEQ_OPTIONAL(
        FT::ACTION(TARGET, [
          'targetPlayer' => ME,
          'targetLocation' => [MANA],
          'targetType' => [CHARACTER, TOKEN, SPELL, PERMANENT],
          'effect' => FT::ACTION(DISCARD, []),
        ]),
        FT::ACTION(TARGET, [
          'targetType' => [PERMANENT],
          'maxHandCost' => 3,
          'effect' => FT::ACTION(DISCARD, []),
        ])
      ),
    ];
  }
}
