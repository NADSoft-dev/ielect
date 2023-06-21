<?php

return [

'filter'=>['IDNumber','FatherName',"gender","Street","haslist","group","manid","birthYear","BoxAddCode","PersonalName","FamilyName","HomeNo","voted","list","mayor"],
'create'=>['full_name'],
'edit'=>['full_name'],

'fields'=>[
  "full_name"=>[
    'type'=>"text",
    'label'=>"שם",
    "list_default"=>true,
  ],




]

];
