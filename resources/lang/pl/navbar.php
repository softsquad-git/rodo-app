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
            'name' => 'trainings',
            'name_sub' => 'certificates',
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
            'name' => 'invoices',
            'name_sub' => 'invoices',
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
            'route' => 'inspector.index',
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
            'name' => 'departments',
            'name_sub' => 'employees',
            'items' => [
                'list' => [
                    'type' => $types['single'],
                    'route' => 'inspector.employees.index',
                    'title' => 'Lista',
                    'icon' => 'si si-list',
                ],
                'departments' => [
                    'type' => $types['single'],
                    'route' => 'inspector.departments.index',
                    'title' => 'Działy',
                    'icon' => 'fa fa-boxes',
                ]
            ]
        ],
        'messages' => [
            'type' => $types['sub'],
            'title' => 'Wiadomości',
            'icon' => 'fa fa-envelope-open-text',
            'name' => 'newsletter',
            'name_sub' => 'newsletter',
            'items' => [
                'newsletter' => [
                    'type' => $types['single'],
                    'route' => 'inspector.newsletter.index',
                    'title' => 'Newsletter',
                    'icon' => 'fa fa-newspaper'
                ],
                'box' => [
                    'type' => $types['single'],
                    'route' => 'inspector.newsletter.mailbox.index',
                    'title' => 'Skrzynka',
                    'icon' => 'fa fa-box-open'
                ]
            ]
        ],
        'tutorials' => [
            'type' => $types['sub'],
            'title' => 'Szkolenia',
            'icon' => 'si si-size-actual',
            'name' => 'trainings',
            'name_sub' => 'trainings',
            'items' => [
                'list' => [
                    'type' => $types['single'],
                    'route' => 'inspector.trainings.index',
                    'title' => 'Lista',
                    'icon' => 'si si-list'
                ],
                'tests' => [
                    'type' => $types['single'],
                    'route' => 'inspector.trainings.tests.index',
                    'title' => 'Testy',
                    'icon' => 'fa fa-university'
                ],
            ]
        ],
        'docs' => [
            'type' => $types['sub'],
            'title' => 'Dokumenty',
            'icon' => 'fa fa-university',
            'name' => 'documents',
            'name_sub' => 'documents',
            'items' => [
                'list' => [
                    'type' => $types['single'],
                    'route' => 'inspector.documents.index',
                    'title' => 'Lista',
                    'icon' => 'si si-list'
                ],
            ]
        ],
        'applications' => [
            'type' => $types['sub'],
            'title' => 'Zgłoszenia',
            'icon' => 'fa fa-eject',
            'name' => 'applications',
            'name_sub' => 'applications',
            'items' => [
                'list' => [
                    'type' => $types['single'],
                    'route' => 'inspector.applications.conclusions.index',
                    'title' => 'Wnioski',
                    'icon' => 'si si-list'
                ],
                'issues' => [
                    'type' => $types['single'],
                    'route' => 'inspector.applications.issues.index',
                    'title' => 'Sprawy',
                    'icon' => 'si si-list'
                ],
                'incidents' => [
                    'type' => $types['single'],
                    'route' => 'inspector.applications.incidents.index',
                    'title' => 'Incydenty',
                    'icon' => 'si si-list'
                ]
            ]
        ],
        'meeting' => [
            'type' => $types['single'],
            'route' => 'inspector.meetings.index',
            'title' => 'Spotkanie',
            'icon' => 'fa fa-handshake',
            'name' => 'meetings'
        ],
        'tasks' => [
            'type' => $types['single'],
            'route' => 'inspector.tasks.index',
            'title' => 'Zadania',
            'icon' => 'fa fa-tasks',
            'name' => 'tasks'
        ],
        'data_sets' => [
            'type' => $types['single'],
            'route' => 'inspector.datasets.index',
            'title' => 'Zbiory danych',
            'icon' => 'fa fa-database',
            'name' => 'datasets'
        ],
        'areas_processing' => [
            'type' => $types['single'],
            'route' => 'inspector.processing_areas.index',
            'title' => 'Obszary przetwarzania',
            'icon' => 'fa fa-table',
            'name' => 'processing-areas'
        ],
        'assets' => [
            'type' => $types['sub'],
            'title' => 'Aktywa',
            'icon' => 'si si-size-actual',
            'name' => 'assets',
            'name_sub' => 'assets',
            'items' => [
                'resources' => [
                    'type' => $types['single'],
                    'route' => 'inspector.assets.resources.index',
                    'title' => 'Zasoby',
                    'icon' => 'si si-list'
                ],
                'it' => [
                    'type' => $types['single'],
                    'route' => 'inspector.assets.system_it.index',
                    'title' => 'System IT',
                    'icon' => 'si si-list'
                ],
            ]
        ],
        'risk_analysis' => [
            'type' => $types['sub'],
            'title' => 'Analiza ryzyka',
            'icon' => 'fa fa-project-diagram',
            'name' => 'risk_analysis',
            'name_sub' => 'risk-analysis',
            'items' => [
                'security' => [
                    'type' => $types['single'],
                    'route' => 'inspector.risk_analysis.security.index',
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
            'name' => 'rcp',
            'name_sub' => 'rcp',
            'items' => [
                'activities' => [
                    'type' => $types['single'],
                    'route' => 'inspector.rcp.activity.index',
                    'title' => 'Czynności',
                    'icon' => 'si si-list'
                ],
                'law_basics' => [
                    'type' => $types['single'],
                    'route' => 'inspector.rcp.law_basic.index',
                    'title' => 'Podstawy prawne',
                    'icon' => 'si si-list'
                ],
                'data_retention' => [
                    'type' => $types['single'],
                    'route' => 'inspector.rcp.data_retention.index',
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
    ],
    'employee' => [
        'dashboard' => [
            'type' => $types['single'],
            'route' => 'employee.index',
            'title' => 'Pulpit',
            'icon' => 'si si-speedometer',
            'name' => 'dashboard'
        ],
        'profile' => [
            'type' => $types['single'],
            'route' => 'employee.profile',
            'title' => 'Profil',
            'icon' => 'si si-user',
            'name' => 'profile'
        ],
        'permissions' => [
            'type' => $types['single'],
            'route' => 'employee.permissions.index',
            'title' => 'Uprawnienia',
            'icon' => 'si si-lock',
            'name' => 'permissions'
        ],
        'tutorials' => [
            'type' => $types['sub'],
            'title' => 'Szkolenia',
            'icon' => 'si si-size-actual',
            'name' => 'trainings',
            'name_sub' => 'trainings',
            'items' => [
                'list' => [
                    'type' => $types['single'],
                    'route' => 'employee.trainings.index',
                    'title' => 'Wykaz',
                    'icon' => 'si si-list'
                ],
                'tests' => [
                    'type' => $types['single'],
                    'route' => 'employee.trainings.tests.index',
                    'title' => 'Testy',
                    'icon' => 'si si-speedometer'
                ],
                'certificates' => [
                    'type' => $types['single'],
                    'route' => 'employee.trainings.certificates.index',
                    'title' => 'Certyfikaty',
                    'icon' => 'si si-trophy'
                ]
            ]
        ],
        'docs' => [
            'type' => $types['single'],
            'title' => 'Dokumenty',
            'route' => 'employee.documents.index',
            'icon' => 'fa fa-university',
            'name' => 'documents'
        ],
        'applications' => [
            'type' => $types['sub'],
            'title' => 'Zgłoszenia',
            'icon' => 'fa fa-eject',
            'name' => 'applications',
            'name_sub' => 'applications',
            'items' => [
                'list' => [
                    'type' => $types['single'],
                    'route' => 'employee.applications.index',
                    'title' => 'Lista',
                    'icon' => 'si si-list'
                ],
                'conclusions' => [
                    'type' => $types['single'],
                    'route' => 'employee.applications.conclusions.index',
                    'title' => 'Wnioski',
                    'icon' => 'si si-list'
                ],
                'issues' => [
                    'type' => $types['single'],
                    'route' => 'employee.applications.issues.index',
                    'title' => 'Sprawy',
                    'icon' => 'si si-list'
                ],
                'incidents' => [
                    'type' => $types['single'],
                    'route' => 'employee.applications.incidents.index',
                    'title' => 'Incydenty',
                    'icon' => 'si si-list'
                ]
            ]
        ],
    ]
];
