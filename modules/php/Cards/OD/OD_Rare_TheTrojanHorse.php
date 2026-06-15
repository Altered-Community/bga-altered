<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_TheTrojanHorse extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_FUGUE_B_OR_145_R1',
      'asset' => 'ALT_FUGUE_B_OR_145_R',
      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('The Trojan Horse'),
      'typeline' => clienttranslate('Character - Construction'),
      'type' => CHARACTER,
      'artist' => 'Saeed Jalabi',
      'extension' => 'NEJ',
      'subtypes' => [CONSTRUCTION],
      'effectDesc' => clienttranslate('Defender.  {J} I #defect#.  When I leave the Expedition zone — My owner creates an Ordis Recruit 1/1/1 Soldier token in each of their Expeditions.'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 5,
      'costReserve' => 5,
      'defender' => true,
      'effectPlayed' => FT::SEQ(
        FT::ACTION(SPECIAL_EFFECT,
          ['effect' => 'defect']
        ),
        FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'targetPlayer' => 'owner',
          'tokenType' => 'OD_Common_OrdisRecruit',
          'targetLocation' => [STORM_RIGHT, STORM_LEFT],
        ]),
      ),
    ];
  }
}
