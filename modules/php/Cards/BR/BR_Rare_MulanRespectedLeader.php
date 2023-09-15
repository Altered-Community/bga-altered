<?php
namespace ALT\Cards\BR;

class BR_Rare_MulanRespectedLeader extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->asset = 'BR-36_Hua_Mulan_02';
    $this->frameSize = 1;

    $this->faction = FACTION_BR;
    $this->name = clienttranslate('Mulan, Respected Leader');
    $this->type = EXPLORER;
    $this->subtype = 'Adventurer';
    $this->rarity = RARITY_RARE;
    $this->forest = 2;
    $this->mountain = 4;
    $this->water = 2;
    $this->costHand = 3;
    $this->costMemory = 3;
  }
}
