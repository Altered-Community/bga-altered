<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Common_Arges extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_FUGUE_B_AX_135_C',
      'asset' => 'ALT_FUGUE_B_AX_135_C',
      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Arges'),
      'typeline' => clienttranslate('Character - Engineer, Titan'),
      'type' => CHARACTER,
      'artist' => 'Anh Tung',
      'extension' => 'NEJ',
      'subtypes' => [ENGINEER, TITAN],
      'effectDesc' => clienttranslate('Gigantic. (I am considered present in each of your Expeditions.) If there are two or more cards in your Landmarks, I gain 1 boost.'),
      'forest' => 6,
      'mountain' => 6,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 3,
      'gigantic' => true,
      'effectPlayed' => FT::ACTION(CHECK_CONDITION, [
        'condition' => 'hasControl:landmark:2', 
        'output' => FT::GAIN(ME, BOOST)
      ]),
    ];
  }
}
