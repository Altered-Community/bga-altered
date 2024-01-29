<?php
namespace ALT\Cards\AX;

class AX_Common_BrassbugHive extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_30_C',
      'asset' => 'ALT_CORE_B_AX_30_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Brassbug Hive'),
      'typeline' => clienttranslate('Permanent - Landmark'),
      'type' => PERMANENT,
      'flavorText' => clienttranslate('What could possibly go wrong with an adorable little self-replicating autonomous robot?'),
      'artist' => 'HuoMiao Studio',
      'subtypes' => [LANDMARK],
      'effectDesc' => clienttranslate(
        '{J} Create a <BRASSBUG> Robot token in target Expedition.  At Noon — Create a <BRASSBUG> Robot token in target Expedition.'
      ),
      'costHand' => 5,
      'costReserve' => 5,
    ];
  }
}
