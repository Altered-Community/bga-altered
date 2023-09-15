<?php
namespace ALT\Cards\BR;

class BR_Base_AltrunTracer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->asset = 'BR-24_AltrunTracer_RGB_01';
    $this->frameSize = 1;

    $this->faction = FACTION_BR;
    $this->name = clienttranslate('Altrun Tracer');
    $this->type = EXPLORER;
    $this->subtype = 'Adventurer';
    $this->rarity = RARITY_BASE;
    $this->forest = 3;
    $this->mountain = 3;
    $this->water = 3;
    $this->costHand = 2;
    $this->costMemory = 2;
  }
}
