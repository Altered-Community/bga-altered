<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_ArmoredBird extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_MU_69_R1',
      'asset'  => 'ALT_CYCLONE_B_MU_69_R',

      'faction'  => FACTION_MU,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Armored Bird"),
      'typeline' => clienttranslate("Character - Animal"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('He raised a shield of feathers. Lances and harpoons shattered against his steely wings.'),
      'artist' => "Victor Canton",
      'extension' => 'SO',
      'subtypes'  => [ANIMAL],
      'effectDesc' => clienttranslate('I am $<DEFENDER> #unless I\'m facing two or more Characters.#'),
      'forest' => 4,
      'mountain' => 5,
      'ocean' => 5,
      'costHand' => 3,
      'costReserve' => 3,
      'changedStats' => ['mountain'],
      'dynamicDefender' => '1:isOpponentExpeditionFilled:character:1:LTE'
    ];
  }
}
