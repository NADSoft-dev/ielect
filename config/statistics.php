<?php

return [

'filter'=>['AddCode','FamilyName',"birthYear","manid","list","group"],
"by"=>[
  [
  'field'=>"FamilyName",
  "label"=>"משפחה",
  ],
  [
  'field'=>"manid",
  "label"=>"אחראי"
  ],
  [
  'field'=>"group",
  "label"=>"קבוצה"
  ],
  [
  'field'=>"list",
  "label"=>"פעיל"
  ],
  [
  'field'=>"AddCode",
  "label"=>"קלפי"
  ],


  [
  'field'=>"birthYear",
  "label"=>"שנת לידה"
  ],


  [
  'field'=>"mayor",
  "label"=>"ראש רשות"
  ],

  [
    'field'=>"Street",
    "label"=>"רחוב"
    ],

],
'edit'=>['IDNumber',"FamilyName","PersonalName","FatherName","AddCode","ballot_address","father_id","mother_id","birthYear","Zip","Address","StCode","HomeNo","Serial","tel","cell",'email','couple'],


'fields'=>[
  "IDNumber"=>[
    'type'=>"text",
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
    'type'=>"text",
    "label"=>"מס' סידורי"
  ],
  "Address"=>[
    'type'=>"text",
    "label"=>"עיר"
  ],
  "haslist"=>[
    "type"=>"select",
    "label"=>"שייך לרשימה",
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
"PersonalName"=>[
  'type'=>"text",
  "label"=>"שם פרטי",
  "list_default"=>true,
],
"FamilyName"=>[
  'type'=>"text",
  "label"=>"משפחה",
  "list_default"=>true,
  'autocomplete'=>'/electors/complete/FamilyName',
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
  "label"=>"רחוב"
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
    0=>'לא'
  ],

],

"mayor"=>[
  "type"=>"select",
  "label"=>"ראש רשות",
  "data"=>"full_name,mayors,id",
],

]

];
