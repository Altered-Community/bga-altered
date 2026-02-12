<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_HavenTrainer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_BR_97_R2',
      'asset'  => 'ALT_DUSTER_B_BR_97_R',

      'faction'  => FACTION_YZ,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Haven Trainer"),
      'typeline' => clienttranslate("Character - Trainer"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"Yeah, you\'ve still got a few things to learn…"'),
      'artist' => "Khoa Viet",
      'extension' => 'SDU',
      'subtypes'  => [TRAINER],
      'effectDesc' => clienttranslate('#{J}# You may <RUSH>. If you would play a card from Reserve this way, you may pay its Hand Cost instead of its Reserve Cost.'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 3,
      'changedStats' => ['ocean'],
      'effectPlayed' => FT::SEQ_OPTIONAL(
        FT::ACTION(CHOOSE_ASSIGNMENT, ['actions' => ['play'], 'reserveFlipCost' => true, 'mandatory' => true])
      )
    ];
  }
}
