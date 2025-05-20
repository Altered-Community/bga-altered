<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_QorganInformant extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_BISE_B_YZ_53_R1',
      'asset'  => 'ALT_BISE_B_YZ_53_R',

      'faction'  => FACTION_YZ,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Qorgan Informant"),
      'typeline' => clienttranslate("Character - Bureaucrat Mage Messenger"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('Shhh. This stays between you and me.'),
      'artist' => "HuoMiao Studio",
      'extension' => 'WFTM',
      'subtypes'  => [BUREAUCRAT, MAGE, MESSENGER],
      'effectDesc' => clienttranslate('#$<SCOUT_1> {1}.#  {H} Remove up to 2 counters from target card in play or in Reserve. (This can\'t target Hero cards.)'),
      'forest' => 2,
      'mountain' => 3,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 2,
      'scout' => 1,
      'effectHand' => FT::ACTION(TARGET, [
        'targetType' => [CHARACTER, SPELL, PERMANENT, TOKEN],
        'targetLocation' => [STORM_LEFT, STORM_RIGHT, LANDMARK, RESERVE],
        'upTo' => true,
        'augmentOnly' => true,
        'effect' => FT::SEQ(
          FT::SEQ_OPTIONAL_MANUAL(
            FT::ACTION(LOOSE, ['upTo' => true, 'type' => 'counter'], ['optional' => true])
          ),
          FT::SEQ_OPTIONAL_MANUAL(
            FT::ACTION(LOOSE, ['upTo' => true, 'type' => 'counter'], ['optional' => true])
          )
        )
      ]),
    ];
  }
}
