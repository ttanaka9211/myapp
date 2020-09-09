<?php

use Cake\ORM\TableRegistry;
use CakeDC\Auth\Rbac\Rules\Owner;

return [
    'Users.SimpleRbac.permissions' => [
        [
            'role' => ['user'],
            'controller' => 'Customers',
            'action' => ['index', 'find', 'add', 'view', 'order']
        ],
        [
            'role' => ['user'],
            'controller' => 'Products',
            'action' => ['index', 'view', 'product']
        ],
        [
            'role' => ['user'],
            'controller' => 'Sales',
            'action' => '*'
        ],
        [
            'role' => ['user'],
            'plugin' => 'CakeDC/Users',
            'controller' => 'Users',
            'action' => ["profile", "logout"],
        ],

        /* [
            'role' => 'superuser',
            'controller' => '*',
            'action' => "*",
        ], */
    ]
];