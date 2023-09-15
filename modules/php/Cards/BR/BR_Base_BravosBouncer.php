<?php
namespace ALT\Cards\BR;

class BR_Base_BravosBouncer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->asset = 'BR-30_SeiringarOldGuard_RGB_01';
    $this->frameSize = 1;

    $this->faction = FACTION_BR;
    $this->name = clienttranslate('Bravos Bouncer');
    $this->type = EXPLORER;
    $this->subtype = 'Blademaster';
    $this->rarity = RARITY_BASE;
    $this->forest = 4;
    $this->mountain = 2;
    $this->water = 4;
    $this->costHand = 3;
    $this->costMemory = 3;
  }
}
