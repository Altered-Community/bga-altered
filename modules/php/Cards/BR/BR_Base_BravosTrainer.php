<?php
namespace ALT\Cards\BR;

class BR_Base_BravosTrainer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->asset = 'OR-33_Aegis Veteran_RGB_01';
    $this->frameSize = 1;

    $this->faction = FACTION_BR;
    $this->name = clienttranslate('Bravos Trainer');
    $this->type = EXPLORER;
    $this->subtype = 'Bowmaster';
    $this->rarity = RARITY_BASE;
    $this->forest = 2;
    $this->mountain = 2;
    $this->water = 2;
    $this->costHand = 2;
    $this->costMemory = 2;
  }
}
