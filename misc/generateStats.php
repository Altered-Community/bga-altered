<?php

for($i=1;$i<=40;$i++){
/*	 printf("\"card" . $i . "\": {\n"
    ."      \"id\": " . 20 + $i. ",\n"
    ."       \"name\": \"card ".$i."\",\n"
    ."       \"type\": \"int\",\n"
    ."       \"display\": \"limited\"\n"
    ."   },\n");*/
	
printf("'card" . $i. "' => [\n"
      ."'id' => STAT_CARD_".$i.",\n"
      ."'name' => 'card " .$i."',\n"
      ."'type' => 'int',\n"
	  ."'display'=>'limited'\n"
    ."],");
}


for($i=1;$i<=40;$i++){
	 printf("CONST STAT_CARD_". $i . "= " . 20+$i.";\n");
}