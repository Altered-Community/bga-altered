<?php
namespace ALT\Cards\BR;

class BR_Base_Booda extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->asset = 'BRext1';
    $this->frameSize = 1;

    $this->faction = FACTION_BR;
    $this->name = clienttranslate('Booda');
    $this->type = EXPLORER;
    $this->subtype = 'Token — Cat';
    $this->rarity = RARITY_BASE;
    $this->forest = 2;
    $this->mountain = 2;
    $this->water = 2;
  }
}
