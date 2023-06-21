<?php

return [

'filter'=>['IDNumber','FatherName',"gender","Street","haslist","group","manid","birthYear","BoxAddCode","PersonalName","FamilyName","HomeNo","voted","list","mayor"],
'create'=>['iden','full_name','phone','cell','email',"statistics","elections_day"],
'edit'=>['iden','full_name','phone','cell','email',"statistics","elections_day"],

'fields'=>[
  "iden"=>[
    'type'=>"text",
    'label'=>"ת.ז",
    "list_default"=>true,
  ],

  "full_name"=>[
    'type'=>"text",
    'label'=>"שם מלא",
    "list_default"=>true,
  ],
  "phone"=>[
    'type'=>"text",
    'label'=>"מס טלפון",
    "list_default"=>true,
  ],

  "statistics"=>[
    'type'=>"select",
    'label'=>"הרשאת סטטיסטיקות",
    'data'=>[
      0=>'לא',
      1=>'כן'
    ],
  ],

  "elections_day"=>[
    'type'=>"select",
    'label'=>"הרשאת יום בחירות",
    'data'=>[
      0=>'לא',
      1=>'כן'
    ],
  ],
  "cell"=>[
    'type'=>"text",
    'label'=>"מס' נייד",
    "list_default"=>true,
  ],

  "email"=>[
    'type'=>"text",
    'label'=>'דוא"ל',
    "list_default"=>true,
  ],

  "under"=>[
    "type"=>"select",
    "label"=>"אחראי",
    "data"=>"full_name,delegate,id",
  ],




]

];
