<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_DellaBolt extends \ALT\Models\Card
{
	public function __construct($row)
	{
		parent::__construct($row);
		$this->properties = [
			'uid' => 'ALT_DUSTER_B_AX_85_C',
			'asset'  => 'ALT_DUSTER_B_AX_85_C',

			'faction'  => FACTION_AX,
			'rarity'  => RARITY_COMMON,
			'name'  => clienttranslate("Della & Bolt"),
			'typeline' => clienttranslate("Axiom Hero"),
			'type'  => HERO,
			'flavorText'  => clienttranslate('Living creatures are the most beautiful mechanisms of all.'),
			'artist' => "Tristan Bideau",
			'extension' => 'SDU',
			'reserveSlots' => 2,
			'landmarkSlots' => 2,
			'thumbnail' => 4,
			'statData' => 25,
			'effectDesc' => clienttranslate('{T} : Ready target Permanent in play or target card in Reserve. This costs {2} more to target a Permanent in play with Hand Cost {5} or more.'),
			'effectTap' => FT::XOR(
				FT::ACTION(TARGET, [
					'targetType' => [PERMANENT],
					'maxHandCost' => 4,
					'isTapped' => true,
					'effect' => FT::ACTION(READY, ['cardId' => EFFECT])
				]),
				FT::ACTION(TARGET, [
					'targetType' => [PERMANENT],
					'minHandCost' => 5,
					'isTapped' => true,
					'effect' => FT::SEQ(
						FT::ACTION(PAY, ['pay' => 2]),
						FT::ACTION(READY, ['cardId' => EFFECT])
					)
				]),
				FT::ACTION(TARGET, [
					'targetType' => [PERMANENT, CHARACTER, SPELL],
					'targetLocation' => [RESERVE],
					'isTapped' => true,
					'effect' => FT::ACTION(READY, ['cardId' => EFFECT])
				])

			)
		];
	}
}
