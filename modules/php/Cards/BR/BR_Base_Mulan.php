<?php
namespace ALT\Cards\BR;

class BR_Base_Mulan extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->asset = 'BR-36_Hua_Mulan_01';
    $this->frameSize = 1;

    $this->faction = FACTION_BR;
    $this->name = clienttranslate('Mulan');
    $this->type = EXPLORER;
    $this->subtype = 'Adventurer';
    $this->rarity = RARITY_BASE;
    $this->forest = 2;
    $this->mountain = 4;
    $this->water = 2;
    $this->costHand = 3;
    $this->costMemory = 3;
  }
}
