<?php
namespace ALT\Cards\BR;

class BR_Base_Ratatosk extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->asset = 'BR-38_Ratatoskr_01';
    $this->frameSize = 1;

    $this->faction = FACTION_BR;
    $this->name = clienttranslate('Ratatosk');
    $this->type = EXPLORER;
    $this->subtype = 'Squirrel';
    $this->rarity = RARITY_BASE;
    $this->forest = 1;
    $this->mountain = 1;
    $this->water = 1;
    $this->costHand = 1;
    $this->costMemory = 1;
  }
}
