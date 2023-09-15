<?php
namespace ALT\Cards\BR;

class BR_Base_KojoandBooda extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->asset = 'BR-01_Ekwu-Booda_RGB_01';
    $this->frameSize = 1;

    $this->faction = FACTION_BR;
    $this->name = clienttranslate('Kojo and Booda');
    $this->type = ALTERATEUR;
    $this->subtype = 'Bravos Hero';
    $this->rarity = RARITY_BASE;
  }
}
