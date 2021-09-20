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
            'route' => 'admin.clients.index',
            'title' => 'Klienci',
            'icon' => 'si si-people'
        ],
        'users' => [
            'type' => $types['single'],
            'route' => 'admin.users.index',
            'title' => 'Użytkownicy',
            'icon' => 'si si-people'
        ],
        'role' => [
            'type' => $types['single'],
            'route' => 'admin.roles.index',
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
                    'route' => 'admin.trainings.index',
                    'title' => 'Lista',
                    'icon' => 'si si-list'
                ],
                'groups' => [
                    'type' => $types['single'],
                    'route' => 'admin.trainings.groups.index',
                    'title' => 'Grupy szkoleń',
                    'icon' => 'si si-grid'
                ],
                'tests' => [
                    'type' => $types['single'],
                    'route' => 'admin.trainings.tests.index',
                    'title' => 'Testy',
                    'icon' => 'si si-speedometer'
                ],
                'certificates' => [
                    'type' => $types['single'],
                    'route' => 'admin.certificates.index',
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
                    'route' => 'admin.invoices.index',
                    'title' => 'Lista',
                    'icon' => 'si si-list'
                ],
                'settings' => [
                    'type' => $types['single'],
                    'route' => 'admin.invoices.settings.index',
                    'title' => 'Ustawienia',
                    'icon' => 'si si-settings'
                ]
            ]
        ],
        'event_log' => [
            'type' => $types['single'],
            'route' => 'admin.logs.index',
            'title' => 'Rejestr zdarzeń',
            'icon' => 'si si-lock'
        ],
        'system' => [
            'type' => $types['single'],
            'route' => 'admin.settings.index',
            'title' => 'System',
            'icon' => 'si si-globe'
        ]
    ],
    'inspector' => [
        'dashboard' => [
            'type' => $types['single'],
            'route' => '',
            'title' => 'Dashboard',
            'icon' => 'fa fa-tachometer-alt'
        ],
        'profile' => [
            'type' => $types['single'],
            'route' => 'inspector.profile',
            'title' => 'Profil',
            'icon' => 'si si-user'
        ],
        'clients' => [
            'type' => $types['sub'],
            'title' => 'Pracownicy',
            'icon' => 'si si-people',
            'items' => [
                'list' => [
                    'type' => $types['single'],
                    'route' => '',
                    'title' => 'Lista',
                    'icon' => 'si si-list'
                ],
                'departments' => [
                    'type' => $types['single'],
                    'route' => '',
                    'title' => 'Działy',
                    'icon' => 'fa fa-boxes'
                ]
            ]
        ],
        'messages' => [
            'type' => $types['sub'],
            'title' => 'Wiadomości',
            'icon' => 'fa fa-envelope-open-text',
            'items' => [
                'newsletter' => [
                    'type' => $types['single'],
                    'route' => '',
                    'title' => 'Newsletter',
                    'icon' => 'fa fa-newspaper'
                ],
                'box' => [
                    'type' => $types['single'],
                    'route' => '',
                    'title' => 'Skrzynka',
                    'icon' => 'fa fa-box-open'
                ]
            ]
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
                'tests' => [
                    'type' => $types['single'],
                    'route' => '',
                    'title' => 'Testy',
                    'icon' => 'fa fa-university'
                ],
            ]
        ],
        'docs' => [
            'type' => $types['sub'],
            'title' => 'Dokumenty',
            'icon' => 'fa fa-university',
            'items' => [
                'list' => [
                    'type' => $types['single'],
                    'route' => '',
                    'title' => 'Lista',
                    'icon' => 'si si-list'
                ],
            ]
        ],
        'applications' => [
            'type' => $types['sub'],
            'title' => 'Zgłoszenia',
            'icon' => 'fa fa-eject',
            'items' => [
                'list' => [
                    'type' => $types['single'],
                    'route' => '',
                    'title' => 'Wnioski',
                    'icon' => 'si si-list'
                ],
                'issues' => [
                    'type' => $types['single'],
                    'route' => '',
                    'title' => 'Sprawy',
                    'icon' => 'si si-list'
                ],
                'incidents' => [
                    'type' => $types['single'],
                    'route' => '',
                    'title' => 'Incydenty',
                    'icon' => 'si si-list'
                ]
            ]
        ],
        'meeting' => [
            'type' => $types['single'],
            'route' => '',
            'title' => 'Spotkanie',
            'icon' => 'fa fa-handshake'
        ],
        'tasks' => [
            'type' => $types['single'],
            'route' => 'inspector.tasks.index',
            'title' => 'Zadania',
            'icon' => 'fa fa-tasks'
        ],
        'data_sets' => [
            'type' => $types['single'],
            'route' => '',
            'title' => 'Zbiory danych',
            'icon' => 'fa fa-database'
        ],
        'areas_processing' => [
            'type' => $types['single'],
            'route' => '',
            'title' => 'Obszary przetwarzania',
            'icon' => 'fa fa-table'
        ],
        'assets' => [
            'type' => $types['sub'],
            'title' => 'Aktywa',
            'icon' => 'si si-size-actual',
            'items' => [
                'resources' => [
                    'type' => $types['single'],
                    'route' => '',
                    'title' => 'Zasoby',
                    'icon' => 'si si-list'
                ],
                'it' => [
                    'type' => $types['single'],
                    'route' => '',
                    'title' => 'System IT',
                    'icon' => 'si si-list'
                ],
            ]
        ],
        'risk_analysis' => [
            'type' => $types['sub'],
            'title' => 'Analiza ryzyka',
            'icon' => 'fa fa-project-diagram',
            'items' => [
                'security' => [
                    'type' => $types['single'],
                    'route' => '',
                    'title' => 'Zabezpieczenia',
                    'icon' => 'fa fa-shield-alt'
                ],
                'threats' => [
                    'type' => $types['single'],
                    'route' => '',
                    'title' => 'Zagrożenia',
                    'icon' => 'fa fa-dice-three'
                ],
                'plans' => [
                    'type' => $types['single'],
                    'route' => '',
                    'title' => 'Plany',
                    'icon' => 'fa fa-globe'
                ],
            ]
        ],
        'rcp' => [
            'type' => $types['sub'],
            'title' => 'RCP',
            'icon' => 'fa fa-qrcode',
            'items' => [
                'activities' => [
                    'type' => $types['single'],
                    'route' => '',
                    'title' => 'Czynności',
                    'icon' => 'si si-list'
                ],
                'law_basics' => [
                    'type' => $types['single'],
                    'route' => '',
                    'title' => 'Podstawy prawne',
                    'icon' => 'si si-list'
                ],
                'data_retention' => [
                    'type' => $types['single'],
                    'route' => '',
                    'title' => 'Retencje danych',
                    'icon' => 'si si-list'
                ],
                'register' => [
                    'type' => $types['single'],
                    'route' => '',
                    'title' => 'Rejestr',
                    'icon' => 'si si-list'
                ],
            ]
        ],
    ]
];
