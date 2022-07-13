<?php

return [
    /*
    |---------------------------------------------------------------------
    | View File(s) Location
    |---------------------------------------------------------------------
    |
    | If you want to use customized view just publish this view files
    | then set your new files location here. I personally don't like
    |  forcing other to make vendor folder project folder etc.
    |
    | N.B: Don't rename index, They are for advanced customization
    |
    | @var string []
    */

    'view' => [
        'login' => 'triplea::auth.login',
        'register' => 'triplea::auth.register',
        'forgot-password' => 'triplea::auth.forgot-password',
        'reset-password' => 'triplea::auth.reset-password',
        'verify-email' => 'triplea::auth.verify-email',
        'confirm-password' => 'triplea::auth.confirm-password',
        'lock-screen' => 'triplea::auth.lock-screen',
    ],
];
