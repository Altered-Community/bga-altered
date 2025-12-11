<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Common_MatzHive extends \ALT\Models\Card
{
	public function __construct($row)
	{
		parent::__construct($row);
		$this->properties = [
			'uid' => 'ALT_DUSTER_B_OR_85_C',
			'asset'  => 'ALT_DUSTER_B_OR_85_C',

			'faction'  => FACTION_OD,
			'rarity'  => RARITY_COMMON,
			'name'  => clienttranslate("Matz & Hive"),
			'typeline' => clienttranslate("Ordis Hero"),
			'type'  => HERO,
			'flavorText'  => clienttranslate('I am the beating heart of the swarm, the architect of the hive.'),
			'artist' => "Justice Wong",
			'extension' => 'SDU',
			'reserveSlots' => 2,
			'landmarkSlots' => 3,
			'thumbnail' => 4,
			'statData' => 27,
			'effectDesc' => clienttranslate('(You may keep up to three cards in your Landmarks during Night.)  At Noon — If there are three or more cards in your Landmarks, you may sacrifice one. If you do, play for free a Landmark Permanent with a max Hand Cost of {2} more than the sacrificed card.'),
			'effectPassive' => [
				'Noon' => [
					'conditions' => ['isMe', 'hasControl:landmark:3'],
					'output' => FT::ACTION(TARGET, [
						'upTo' => true,
						'targetPlayer' => ME,
						'targetType' => [PERMANENT],
						'targetLocation' => [LANDMARK],
						'effect' => FT::SEQ(
							FT::ACTION(DISCARD, ['desc' => 'sacrifice']),
							FT::ACTION(TARGET, [
								'targetPlayer' => ME,
								'targetType' => [PERMANENT],
								'targetLocation' => [HAND, RESERVE],
								'subType' => LANDMARK,
								'maxHandCost' => 'discard2',
								'effect' => FT::ACTION(PLAY_CARD, ['free' => true, 'location' => LANDMARK]),
							])
						)
					])
				]
			]
		];
	}
}
