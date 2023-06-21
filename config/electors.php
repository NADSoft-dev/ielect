<?php

return [

'filter'=>['IDNumber','FamilyName',"originalFamilyName","gender","Street","haslist","hasgroup","manid","birthYear","AddCode","PersonalName","FatherName","HomeNo","voted","list","group","mayor","orderBy"],
'edit'=>['IDNumber',"FamilyName","PersonalName","FatherName","AddCode","ballot_address","father_id","mother_id","birthYear","Zip","Address","StCode","HomeNo","Serial","tel","cell",'email','couple'],
'filter_fields'=>['IDNumber','FamilyName',"originalFamilyName","PersonalName","FatherName","gender","birthYear","couple",'tel','cell','email','Serial','AddCode','ballot_address','Street','Address','HomeNo','StCode','manid','list','mayor','group','voted'],

'fields'=>[
  "IDNumber"=>[
    'type'=>"disabled",
    'label'=>"ת.ז",
    "list_default"=>true,
    
  
  ],


  "FatherName"=>[
    'type'=>"text",
    'label'=>"שם האב",
    "list_default"=>true,
  ],
  "gender"=>[
    'type'=>"select",
    'label'=>"מין",
    "list_default"=>true,
    'data'=>[
      1=>'זכר',
      2=>'נקבה'
    ],
  ],
  "Street"=>[
    'type'=>"text",
    "label"=>"רחוב"
  ],
  "tel"=>[
    'type'=>"text",
    "label"=>"מס' טלפון"
  ],

  "orderBy"=>[
    "type"=>"select",
    "label"=>"מיון לפי",
    'data'=>[
    'AddCode:ASC|Serial:ASC'=>'קלפי-סידורי',
    'IDNumber:ASC'=>'ת.ז',
    'FamilyName:ASC|FatherName:ASC'=>'שם משפחה ,שם האב ',
    'FamilyName:ASC|PersonalName:ASC'=>'שם משפחה ,שם פרטי',
    'birthYear:ASC'=>'שנת לידה',
    "StCode:ASC|Serial:ASC|AddCode:ASC"=>"מס' רחוב ,סידורי וקלפי",
  
    ],
  
  ],


  "couple"=>[
    'type'=>"text",
    "label"=>"בן/בת זוג"
  ],

  "email"=>[
    'type'=>"text",
    "label"=>'דוא"ל'
  ],
  "cell"=>[
    'type'=>"text",
    "label"=>"טלפון נייד"
  ],
  "Serial"=>[
    'type'=>"disabled",
    "label"=>"מס' סידורי",
    "list_default"=>true,
  ],
  "Address"=>[
    'type'=>"text",
    "label"=>"עיר"
  ],
  "haslist"=>[
    "type"=>"select",
    "label"=>"שייך לפעיל",
    'data'=>[
      1=>'כן',
      2=>'לא'
    ],
  ],
    "hasgroup"=>[
      "type"=>"select",
      "label"=>"שייך לקבוצה",
      'data'=>[
        1=>'כן',
        2=>'לא'
      ],

  ],
  "group"=>[
    "type"=>"select",
    "label"=>"קבוצה",
    "data"=>"name,groups,id",
  ],

  "manid"=>[
    "type"=>"select",
    "label"=>"אחראי",
    "data"=>"full_name,delegate,id",
  ],



  "birthYear"=>[
    "type"=>"range",
    "label"=>"שנת לידה",
    "list_default"=>true,
  ],
  "AddCode"=>[
  "type"=>"range",
  "label"=>"קלפי",
  "list_default"=>true,

],

"AddCodeAdress"=>[
  "type"=>"text",
  "label"=>"מקום קלפי",

],


"PersonalName"=>[
  'type'=>"disabled",
  "label"=>"שם פרטי",
  "list_default"=>true,
],
"FamilyName"=>[
  'type'=>"text",
  "label"=>"משפחה",
  'autocomplete'=>'/electors/complete/FamilyName',
  "list_default"=>true,
],


"originalFamilyName"=>[
  'type'=>"text",
  "label"=>"משפחה מיקורי",
  'autocomplete'=>'/electors/complete/originalFamilyName',
  "list_default"=>false,
],
"HomeNo"=>[
  'type'=>"text",
  "label"=>"מס' בית"
],
"mother_id"=>[
  'type'=>"text",
  "label"=>"ת.ז אם"
],
"father_id"=>[
  'type'=>"text",
  "label"=>"ת.ז אב"
],
"Zip"=>[
  'type'=>"text",
  "label"=>"מיקוד"
],

"StCode"=>[
  'type'=>"text",
  "label"=>"מס' רחוב"
],
"ballot_address"=>[
  'type'=>"disabled",
  "label"=>"מקום קלפי"
],
"list"=>[
  "type"=>"select",
  "label"=>"פעיל",
  "data"=>"full_name,personal_list,id",
],
"voted"=>[
  "type"=>"select",
  "label"=>"הצביע",
  'data'=>[
    1=>'כן',
    2=>'לא'
  ],

],

"mayor"=>[
  "type"=>"select",
  "label"=>"ראש רשות",
  "data"=>"full_name,mayors,id",
],

]

];
