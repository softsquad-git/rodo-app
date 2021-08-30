<?php

$types = [
    'single' => 1,
    'sub' => 2
];

return [
    'admin' => [
        'dashboard' => [
            'type' => $types['single'],
            'route' => 'admin.index',
            'title' => 'Pulpit',
            'icon' => 'si si-speedometer'
        ],
        'profile' => [
            'type' => $types['single'],
            'route' => 'admin.profile',
            'title' => 'Profil',
            'icon' => 'si si-user'
        ],
        'clients' => [
            'type' => $types['single'],
            'route' => '',
            'title' => 'Klienci',
            'icon' => 'si si-people'
        ],
        'users' => [
            'type' => $types['single'],
            'route' => '',
            'title' => 'Użytkownicy',
            'icon' => 'si si-people'
        ],
        'role' => [
            'type' => $types['single'],
            'route' => '',
            'title' => 'Role',
            'icon' => 'si si-crop'
        ],
        'tutorials' => [
            'type' => $types['sub'],
            'title' => 'Szkolenia',
            'icon' => 'si si-size-actual',
            'items' => [
                'list' => [
                    'type' => $types['single'],
                    'route' => '',
                    'title' => 'Lista',
                    'icon' => 'si si-list'
                ],
                'groups' => [
                    'type' => $types['single'],
                    'route' => '',
                    'title' => 'Grupy szkoleń',
                    'icon' => 'si si-grid'
                ],
                'tests' => [
                    'type' => $types['single'],
                    'route' => '',
                    'title' => 'Testy',
                    'icon' => 'si si-speedometer'
                ],
                'certificates' => [
                    'type' => $types['single'],
                    'route' => '',
                    'title' => 'Certyfikaty',
                    'icon' => 'si si-trophy'
                ]
            ]
        ],

        'invoices' => [
            'title' => 'Faktury',
            'type' => $types['sub'],
            'icon' => 'si si-printer',
            'items' => [
                'list' => [
                    'type' => $types['single'],
                    'route' => '',
                    'title' => 'Lista',
                    'icon' => 'si si-list'
                ],
                'settings' => [
                    'type' => $types['single'],
                    'route' => '',
                    'title' => 'Ustawienia',
                    'icon' => 'si si-settings'
                ]
            ]
        ],
        'event_log' => [
            'type' => $types['single'],
            'route' => '',
            'title' => 'Rejestr zdarzeń',
            'icon' => 'si si-lock'
        ],
        'system' => [
            'type' => $types['single'],
            'route' => 'admin.settings.index',
            'title' => 'System',
            'icon' => 'si si-globe'
        ]
    ]
];
