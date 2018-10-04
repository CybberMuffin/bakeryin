<?php

return [
    'all' => [
        'login',
        'register',
        'logout'
    ],
    'authorized' => [
        '',
        'logout',
        'addToCart',
        'close',
        'order',
        'pay'
    ],
    'guest' => [
        'login',
        'register',
        'recovery',
        'startRecovery',
        'confirmRecovery',
        'confirmRegistration'
    ],
    'admin' => [
        'admin',
        'logout',
        'adm_out',
        'editProduct',
        'editUser',
        'editOrder'
    ]
];