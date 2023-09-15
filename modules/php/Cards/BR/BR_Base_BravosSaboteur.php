<?php
namespace ALT\Cards\BR;

class BR_Base_BravosSaboteur extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->asset = 'BR-19_MiskiCalderon_RGB_01';
    $this->frameSize = 1;

    $this->faction = FACTION_BR;
    $this->name = clienttranslate('Bravos Saboteur');
    $this->type = EXPLORER;
    $this->subtype = 'Adventurer';
    $this->rarity = RARITY_BASE;
    $this->forest = 3;
    $this->mountain = 3;
    $this->water = 1;
    $this->costHand = 3;
    $this->costMemory = 3;
  }
}
