<?php
namespace ALT\Cards\AX;

class AX_Rare_TheFrogPrince extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_09_R2',
      'asset' => 'ALT_CORE_B_OR_09_R1',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => 'The Frog Prince',
      'typeline' => 'Character - Bureaucrat Noble',
      'type' => CHARACTER,
      'flavorText' => "Thankfully, he doesn\'t seal his contracts with a kiss.",
      'artist' => 'Gaga Zhou',
      'subtypes' => [BUREAUCRAT, NOBLE],
      'supportDesc' => '#{D} : The next Permanent you play this turn costs {1} less.# (Discard me from Reserve to do this.)',
      'forest' => 3,
      'mountain' => 0,
      'ocean' => 3,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
