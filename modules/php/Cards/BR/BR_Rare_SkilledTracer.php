<?php
namespace ALT\Cards\BR;

class BR_Rare_SkilledTracer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->asset = 'BR-24_AltrunTracer_RGB_02';
    $this->frameSize = 1;

    $this->faction = FACTION_BR;
    $this->name = clienttranslate('Skilled Tracer');
    $this->type = EXPLORER;
    $this->subtype = 'Adventurer';
    $this->rarity = RARITY_RARE;
    $this->forest = 4;
    $this->mountain = 3;
    $this->water = 4;
    $this->costHand = 2;
    $this->costMemory = 2;
  }
}
