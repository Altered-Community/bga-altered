<?php
namespace ALT\Cards\BR;

class BR_Base_Intimidation extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->asset = 'BR-33_TheHighGround_RGB_01';
    $this->frameSize = 1;

    $this->faction = FACTION_BR;
    $this->name = clienttranslate('Intimidation');
    $this->type = SPELL;
    $this->subtype = '';
    $this->rarity = RARITY_BASE;
    $this->costHand = 2;
    $this->costMemory = 2;
  }
}
