<?php
namespace ALT\Cards\BR;

class BR_PhysicalTraining extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->asset = "BR-17_GerichtVanBraast_RGB_01";
        $this->frameSize = 1;

        $this->faction = FACTION_BR;
        $this->name = clienttranslate("Physical Training");
        $this->type = SPELL;
        $this->subtype = "";
        $this->rarity = RARITY_BASE;
        $this->costHand = 2;
        $this->costMemory = 2;
    }
}
