<?php
namespace ALT\Cards\BR;

class BR_Base_Atlas extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->asset = 'BR_20_Atlas_RGB_01';
    $this->frameSize = 1;

    $this->faction = FACTION_BR;
    $this->name = clienttranslate('Atlas');
    $this->type = EXPLORER;
    $this->subtype = 'Titan';
    $this->rarity = RARITY_BASE;
    $this->forest = 3;
    $this->mountain = 3;
    $this->water = 3;
    $this->costHand = 5;
    $this->costMemory = 5;
  }
}
