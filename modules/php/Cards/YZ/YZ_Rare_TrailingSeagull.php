<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Rare_TrailingSeagull extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_FUGUE_B_AX_131_R2',
      'asset' => 'ALT_FUGUE_B_AX_131_R',
      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Trailing Seagull'),
      'typeline' => clienttranslate('Character - Animal'),
      'flavorText'  => clienttranslate('To navigate these uncharted waters, Sierra placed beacons on the back of seagulls to triangulate their position.'),
      'artist' => 'Anh Tung',
      'extension' => 'NEJ',
      'type' => CHARACTER,
      'subtypes' => [ANIMAL],
      'effectDesc' => clienttranslate('#{R} I gain 1 boost.#'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 0,
      'costHand' => 0,
      'costReserve' => 2,
      'effectReserve' => FT::GAIN(ME, BOOST),
    ];
  }
}
