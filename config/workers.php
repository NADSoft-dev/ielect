<?php

return [

'create'=>['full_name','iden','cell','kalfy','shift'],
'fields'=>[
  "full_name"=>[
    'type'=>"text",
    'label'=>"שם",
    'required'=>true,
  ],
  "iden"=>[
    'type'=>"text",
    'label'=>"ת.ז",
    'required'=>true,
  ],
  "cell"=>[
    'type'=>"text",
    'label'=>"טלפון נייד",
    'required'=>true,
  ],

  "kalfy"=>[
    'type'=>"select",
    'label'=>"קלפי",
    "data"=>"ballot_id,ballot,ballot_id",
    'required'=>true,
  ],

  "shift"=>[
    'type'=>"select",
    'label'=>"משמרת",
    'required'=>true,
    'data'=>[
      1=>'בוקר',
      2=>'ערב',
      3=>'ספירת קולות'
    ],
  ],
]

];
