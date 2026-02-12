<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Common_TuruunBenih extends \ALT\Models\Card
{
	public function __construct($row)
	{
		parent::__construct($row);
		$this->properties = [
			'uid' => 'ALT_DUSTER_B_MU_85_C',
			'asset'  => 'ALT_DUSTER_B_MU_85_C',

			'faction'  => FACTION_MU,
			'rarity'  => RARITY_COMMON,
			'name'  => clienttranslate("Turuun & Benih"),
			'typeline' => clienttranslate("Muna Hero"),
			'type'  => HERO,
			'flavorText'  => clienttranslate('Bringing a fruit of the Spindle Tree to the Reka is a way for me to recapture my youth.'),
			'artist' => "Ba Vo",
			'extension' => 'SDU',
			'reserveSlots' => 2,
			'landmarkSlots' => 2,
			'thumbnail' => 4,
			'statData' => 26,
			'effectDesc' => clienttranslate('When you make a <GIFT> — You may exhaust me ({T}) to also receive it. (A Gift is when on your turn, an opponent draws a card, Resupplies or receives a token.)  Ignore my ability during the first Day.'),
			'effectPassive' => [
				'InvokeToken' => [
					'conditions' => ['isMyTurn', 'isNotFirstTurn', 'isAfternoon', 'isNotMeInvoke', 'notTapped'],
					'output' => FT::SEQ_OPTIONAL(
						FT::ACTION(TAP, ['cardId' => ME]),
						FT::ACTION(SPECIAL_EFFECT, ['effect' => 'copyGift'])
					)
				],
				'Draw' => [
					'conditions' => ['isMyTurn', 'isNotFirstTurn', 'isAfternoon', 'isNotMe', 'notTapped'],
					'output' => FT::SEQ_OPTIONAL(
						FT::ACTION(TAP, ['cardId' => ME]),
						FT::ACTION(SPECIAL_EFFECT, ['effect' => 'copyGift'])
					)
				],
				'Resupply' => [
					'conditions' => ['isMyTurn', 'isNotFirstTurn', 'isAfternoon', 'isNotMe', 'notTapped'],
					'output' => FT::SEQ_OPTIONAL(
						FT::ACTION(TAP, ['cardId' => ME]),
						FT::ACTION(SPECIAL_EFFECT, ['effect' => 'copyGift'])
					)
				]
			]
		];
	}
}
