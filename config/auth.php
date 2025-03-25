<?php

return [

    'defaults' => [
        'guard' => 'empleado', // Cambiado de 'web' a 'empleado'
        'passwords' => 'empleado', // Cambiado de 'users' a 'empleado'
    ],

'guards' => [
    'empleado' => [
        'driver' => 'session',
        'provider' => 'empleados',  // Asegúrate de que coincida con la clave de 'providers'
    ],
],

'providers' => [
    'empleados' => [  // Debe coincidir con el provider del guard
        'driver' => 'eloquent',
        'model' => App\Models\Empleado::class,
    ],
],


    'passwords' => [
        'empleado' => [
            'provider' => 'empleado',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
