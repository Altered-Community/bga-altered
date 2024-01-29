<?php
namespace ALT\Cards\YZ;

class YZ_Rare_BrassbugHive extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_30_R2',
      'asset' => 'ALT_CORE_B_AX_30_R1',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => 'Brassbug Hive',
      'typeline' => 'Permanent - Landmark',
      'type' => PERMANENT,
      'flavorText' => 'What could possibly go wrong with an adorable little self-replicating autonomous robot?',
      'artist' => 'HuoMiao Studio',
      'subtypes' => [LANDMARK],
      'effectDesc' =>
        '{J} Create a <BRASSBUG> Robot token in target Expedition.  At Noon — Create a <BRASSBUG> Robot token in target Expedition.',
      'costHand' => 5,
      'costReserve' => 5,
    ];
  }
}
