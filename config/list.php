<?php

return [

'filter'=>['IDNumber','FatherName',"gender","Street","haslist","group","manid","birthYear","BoxAddCode","PersonalName","FamilyName","HomeNo","voted","list","mayor"],
'create'=>['iden','full_name','phone','cell','email','under'],
'create_pop'=>['full_name','under'],
'edit'=>['iden','full_name','phone','cell','email','under'],

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
  "manid"=>[
    "type"=>"rselect",
    "label"=>"אחראי",
    "rselect"=>"/list/by-delegate",
    'rselectid'=>"addtolisetselect",
    "data"=>"full_name,delegate,id",
  ],
  "list"=>[
    "type"=>"select",
    "label"=>"פעיל",
    'disabled'=>true,
    "data"=>"full_name,personal_list,id",
    'id'=>"addtolisetselect",
  ],

  "phone"=>[
    'type'=>"text",
    'label'=>"מס טלפון",
    "list_default"=>true,
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
