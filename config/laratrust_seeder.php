<?php

return [
    'role_structure' => [
        'manager' => [
            'dashboard' => 'c,r,u.d'
        ],
        'user' => [
            'users' => 'c,r,u,d',
        ],
    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
