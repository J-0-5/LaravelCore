<?php

return [
    'modules' => [
        'dashboard' => [
            'name' => 'Dashboard', 'reference' => 'dashboard', 'icon' => '1.svg', 'position' => '6',
            'actions' => '1',
            'children' => [],
            'permission' => [
                'Admin' =>  ['role_id' => 1, 'actions' => '6'],
                'Docente' => ['role_id' => 2, 'actions' => '6'],
                'Estudiante' => ['role_id' => 3, 'actions' => '6'],
            ],
        ],

        'users' => [
            'name' => 'Usuarios', 'reference' => 'users', 'icon' => '', 'position' => '3',
            'actions' => '1,2,3,4,5,6,7,8',
            'children' => [],
            'permission' => [
                'Admin' =>  ['role_id' => 1, 'actions' => '6,7,8,9,10,11,12,13'],
                'Docente' => ['role_id' => 2, 'actions' => '6'],
                'Estudiante' => ['role_id' => 3, 'actions' => '6'],
            ]
        ],

        'parameters' => [
            'name' => 'Parámetros', 'reference' => 'parameters', 'icon' => '', 'position' => '4',
            'actions' => '1,2,3,4,5,6,7,8',
            'children' => [],
            'permission' => [
                'Admin' =>  ['role_id' => 1, 'actions' => '6,7,8,9,10,11,12,13'],
                'Docente' => ['role_id' => 2, 'actions' => '6'],
                'Estudiante' => ['role_id' => 3, 'actions' => '6'],
            ]
        ],

        'notifications' => [
            'name' => 'Notificaciones', 'reference' => 'notifications', 'icon' => '9.svg', 'position' => '13',
            'actions' => '1,2,3,4,5,6,7,8',
            'children' => [],
            'permission' => [
                'Admin' =>  ['role_id' => 1, 'actions' => '6,7,8,9,10,11,12,13'],
                'Docente' => ['role_id' => 2, 'actions' => '6'],
                'Estudiante' => ['role_id' => 3, 'actions' => '6'],
            ]
        ],

        'docManagement' => [
            'name' => 'Gestión documental', 'reference' => 'docManagement', 'icon' => '11.svg', 'position' => '11',
            'actions' => '1,2,3,4,5,6,7,8',
            'children' => [],
            'permission' => [
                'Admin' =>  ['role_id' => 1, 'actions' => '6,7,8,9,10,11,12,13'],
                'Docente' => ['role_id' => 2, 'actions' => '6'],
                'Estudiante' => ['role_id' => 3, 'actions' => '6'],
            ]
        ],

    ],
];
