<?php

return [
    '' => [
        'controller' => 'pages',
        'action' => 'main'
    ],
    'registration' => [
      'controller' => 'pages',
      'action' => 'registration'
    ],
    'authorization' => [
      'controller' => 'pages',
      'action' => 'authorization'
    ],
    'registration/confirm\?.*' => [
        'controller' => 'account',
        'action' => 'confirmRegistration'
    ],
    'admin\?.*' => [
        'controller' => 'pages',
        'action' => 'admin'
    ],
    'admin' => [
        'controller' => 'pages',
        'action' => 'admin'
    ],
    'about' => [
        'controller' => 'pages',
        'action' => 'about'
    ],
    'gallery\?.*' => [
        'controller' => 'pages',
        'action' => 'gallery'
    ],
    'gallery/filter' => [
        'controller' => 'pages',
        'action' => 'filter'
    ],
    'gallery/product\?.*' => /*\?.**/
    [
        'controller' => 'pages',
        'action' => 'product'
    ],
    'cart' => [
        'controller' => 'pages',
        'action' => 'cart'
    ],
    'cart/payment' => [
        'controller' => 'pages',
        'action' => 'payment'
    ],
    'services' => [
        'controller' => 'pages',
        'action' => 'services'
    ],
    'contacts' => [
        'controller' => 'pages',
        'action' => 'contacts'
    ],
    'account/login' => [
        'controller' => 'account',
        'action' => 'login'
    ],
    'account/register' => [
        'controller' => 'account',
        'action' => 'register'
    ],
    'account/startRecovery' => [
        'controller' => 'account',
        'action' => 'startRecovery'
    ],
    'account/recovery' => [
        'controller' => 'account',
        'action' => 'recovery'
    ],
    'account/recovery/confirm\?.*' => [
      'controller' => 'account',
      'action' => 'confirmRecovery'
    ],
    'account/logout' => [
        'controller' => 'account',
        'action' => 'logout'
    ],
    'account/adm_out' => [
        'controller' => 'account',
        'action' => 'adm_out'
    ],
    'account/admin/editProduct' => [
        'controller' => 'account',
        'action' => 'editProduct'
    ],
    'account/admin/editUser' => [
        'controller' => 'account',
        'action' => 'editUser'
    ],
    'account/admin/editOrder' => [
        'controller' => 'account',
        'action' => 'editOrder'
    ],
    'account/addToCart' => [
        'controller' => 'account',
        'action' => 'addToCart'
    ],
    'account/cart/close' => [
        'controller' => 'account',
        'action' => 'close'
    ],
    'account/cart/order' => [
        'controller' => 'account',
        'action' => 'order'
    ],
    'account/cart/pay' => [
        'controller' => 'account',
        'action' => 'pay'
    ],
    'account/buy' => [
        'controller' => 'account',
        'action' => 'buy'
    ]
];