<?php
return [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        //'/' => 'site/index',
        'set/<smak:\w+>' => 'set/index/',
        'set/<smak:\w+>/<good:\w+>' => 'set/good/',
        'basket/<ordero:\d+>' => 'basket/success/',
        'feedback/<numero:\w+>' => 'site/feedback',
        'backup/<num:\w+>' => 'site/backup',
        'upload/' => 'site/upload',
        'sign/' => 'site/sign',
        'news/' => 'site/news',
        'fresh/' => 'site/fresh',
        'promo/' => 'site/promo',
        'popular/' => 'site/popular',
        'vacancy/' => 'site/vacancy',
        'agreement/' => 'site/agreement',
        'actiones/' => 'site/actiones',
        'consumer/' => 'site/consumer',
        'about/' => 'site/about',
        'partner/' => 'site/partner',
        'bonuses/' => 'site/bonuses',
        'agreement/' => 'site/agreement',
        'comment/' => 'site/comment',
        'map/' => 'site/map',
        'contacts/' => 'site/contacts',
        'business/' => 'site/business',
        'login/' => 'site/login',
        'admin/product/update/<prid:\d+>' => 'admin/product/update/',
        'admin/product/nameup' => 'admin/product/nameup/',
        'admin/product/namedown' => 'admin/product/namedown/',
        'admin/product/categoryup' => 'admin/product/categoryup/',
        'admin/product/categorydown' => 'admin/product/categorydown/',
        'admin/category/update/<prid:\d+>' => 'admin/category/update/',
        'admin/orders/update/<prid:\d+>' => 'admin/orders/update/',
        'admin/news/update/<prid:\d+>' => 'admin/news/update/',
        'admin/vacancy/update/<prid:\d+>' => 'admin/vacancy/update/',
        'admin/actions/update/<prid:\d+>' => 'admin/action/update/',
        'admin/comments/update/<prid:\d+>' => 'admin/comments/update/',
        'admin/allcomments/update/<prid:\d+>' => 'admin/allcomments/update/',
        'admin/clients/update/<prid:\d+>' => 'admin/clients/update/',
        'admin/polygons/show/<prid:\d+>' => 'admin/polygons/show/',
        'admin/orders/pdf/<prid:\w+>' => 'admin/orders/pdf/',
        'admin/orders/pdfs/<prid:\w+>' => 'admin/orders/pdfs/',
        'news/<numnew:\w+>' => 'site/allnews',
        'vacancy/<vaca:\w+>' => 'site/vacancion',
        'action/<actes:\w+>' => 'site/allactions',
        'login/<service:google|facebook|etc>' => 'site/login',
        //'profile/<action>'=>'profile/<action>',    
        //'<action>'=>'site/<action>',          
    ]
];