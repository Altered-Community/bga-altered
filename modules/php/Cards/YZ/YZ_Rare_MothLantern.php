<?php
namespace ALT\Cards\YZ;

class YZ_Rare_MothLantern extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_YZ_44_R1',
            'asset'  => 'ALT_ALIZE_B_YZ_44_R',

    		'faction'  => FACTION_YZ,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Moth Lantern"),
            'typeline' => clienttranslate("Expedition_permanent - Gear"),
    		'type'  => PERMANENT,
    		'flavorText'  => clienttranslate('In the tricks of its light, shed your skin to become an illusion.'),
            'artist' => "HuoMiao Studio",
			'extension'=>'TBF',
   'subtypes'  => [GEAR,EXPEDITION],
 				'effectDesc' => clienttranslate('When you sacrifice a non-Illusion Character — Create a <MANA_MOTH> Illusion token in my Expedition.  {J} Sacrifice a Character in my Expedition.'),
     'costHand' => 2, 
     'costReserve' => 2, 
     'changedStats' => ['costHand'], 
];
  }
}
