<?php

return [
'edit'=>['name','app_logo','print_logo','address','phone','cell','notes'],

'fields'=>[
  "name"=>[
    'type'=>"text",
    'label'=>"שם רשימה",
    "list_default"=>true,
  ],

  "app_logo"=>[
    'type'=>"image",
    'label'=>"לוגו",
  ],
  "print_logo"=>[
    'type'=>"image",
    'label'=>"לוגו מדבקות",
  ],
  "cell"=>[
    'type'=>"text",
    'label'=>"מס' נייד",
  ],
  "phone"=>[
    'type'=>"text",
    'label'=>"מס' טלפון",
  ],


  "notes"=>[
    'type'=>"text",
    'label'=>'הערות',
  ],

  "address"=>[
    'type'=>"text",
    'label'=>'כתובת',
  ],




]

];
