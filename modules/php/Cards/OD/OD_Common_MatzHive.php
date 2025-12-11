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
			'effectDesc' => clienttranslate('(You may keep up to three cards in your Landmarks during Night.)  At Noon — If there are three or more cards in your Landmarks, you may sacrifice one. If you do, play for free a Landmark Permanent with a max Hand Cost of {2} more than the sacrificed card.'),
		];
	}
}
