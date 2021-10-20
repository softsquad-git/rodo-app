<?php

return [
    'tasks' => [
        'title' => 'Zadania',
        'form' => [
            'create' => [
                'title' => 'Dodaj zadanie'
            ],
            'edit' => [
                'title' => 'Edytuj zadanie'
            ],
            'name' => 'Nazwa',
            'status' => 'Status',
            'description' => 'Opis',
            'deadline' => 'Termin do',
            'user' => 'Przydzielone do',
            'attachments' => 'Załączniki'
        ]
    ],
    'employees' => [
        'title' => 'Pracownicy',
        'form' => [
            'create' => [
                'title' => 'Dodaj pracownika'
            ],
            'edit' => [
                'title' => 'Edytuj pracownika'
            ]
        ]
    ],
    'departments' => [
        'title' => 'Działy',
        'form' => [
            'create' => [
                'title' => 'Dodaj dział'
            ],
            'edit' => [
                'title' => 'Edytuj dział'
            ]
        ]
    ],
    'newsletter' => [
        'title' => 'Newsletter',
        'form' => [
            'create' => [
                'title' => 'Dodaj wpis'
            ],
            'edit' => [
                'title' => 'Edytuj wpis'
            ],
            'title' => 'Tytuł',
            'from' => 'Ważny od',
            'to' => 'Ważny do',
            'content' => 'Treść',
            'status' => 'Status',
            'clients' => 'Firmy'
        ],
        'mailbox' => [
            'title' => 'Skrzynka'
        ]
    ],
    'documents' => [
        'title' => 'Dokumenty',
        'form' => [
            'create' => [
                'title' => 'Dodaj dokument'
            ],
            'edit' => [
                'title' => 'Edytuj dokument'
            ]
        ]
    ],
    'applications' => [
        'conclusions' => [
            'title' => 'Wnioski',
            'form' => [
                'create' => [
                    'title' => 'Dodaj wniosek'
                ],
                'edit' => [
                    'title' => 'Edytuj wniosek'
                ],
                'title' => 'Tytuł wniosku',
                'name' => 'Imię i nazwisko',
                'type' => 'Rodzaj wniosku',
                'date_application' => 'Data złożenia',
                'content' => 'Treść wniosku',
                'status' => 'Status',
                'employee_accepted' => 'Osoba której akceptacja jest wymagana',
                'file' => 'Załącznik'
            ]
        ],
        'issues' => [
            'title' => 'Sprawy',
            'form' => [
                'create' => [
                    'title' => 'Dodaj sprawę'
                ],
                'edit' => [
                    'title' => 'Edytuj sprawę'
                ]
            ]
        ],
        'incidents' => [
            'title' => 'Incydenty',
            'form' => [
                'create' => [
                    'title' => 'Dodaj incydent'
                ],
                'edit' => [
                    'title' => 'Edytuj incident'
                ]
            ]
        ]
    ],
    'meetings' => [
        'title' => 'Spotkania',
        'form' => [
            'create' => [
                'title' => 'Utwórz spotkanie'
            ],
            'edit' => [
                'title' => 'Edytuj spotkanie'
            ]
        ]
    ],
    'datasets' => [
        'title' => 'Zbiory danych',
        'form' => [
            'create' => [
                'title' => 'Dodaj zbiór'
            ],
            'edit' => [
                'title' => 'Edytuj zbiór'
            ]
        ]
    ],
    'assets' => [
        'system_it' => [
            'title' => 'System IT',
            'form' => [
                'create' => [
                    'title' => 'Dodaj system'
                ],
                'edit' => [
                    'title' => 'Edytuj system'
                ],
                'name' => 'Nazwa',
                'owner' => 'Właściciel',
                'description' => 'Opis',
                'type' => 'Rodzaj',
                'status' => 'Status',
                'security' => 'Zabezpieczenia'
            ]
        ],
        'resources' => [
            'title' => 'Zasoby',
            'form' => [
                'create' => [
                    'title' => 'Dodaj zasób'
                ],
                'edit' => [
                    'title' => 'Edytuj zasób'
                ],
                'name' => 'Nazwa',
                'owner' => 'Właściciel',
                'description' => 'Opis',
                'type' => 'Rodzaj',
                'status' => 'Status',
                'security' => 'Zabezpieczenia'
            ],
        ]
    ],
    'risk_analysis' => [
        'security' => [
            'title' => 'Zabezpieczenia',
            'form' => [
                'create' => [
                    'title' => 'Dodaj zabezpieczenie'
                ],
                'edit' => [
                    'title' => 'Edytuj zabezpieczenie'
                ],
                'name' => 'Nazwa',
                'status' => 'Status',
                'type' => 'Rodzaj',
                'description' => 'Opis'
            ]
        ]
    ],
    'rcp' => [
        'law_basic' => [
            'title' => 'Podstawy prawne',
            'form' => [
                'create' => [
                    'title' => 'Dodaj'
                ],
                'edit' => [
                    'title' => 'Edytuj'
                ],
                'name' => 'Nazwa',
                'status' => 'Status',
                'description' => 'Opis'
            ]
        ],
        'activity' => [
            'title' => 'Czynności',
            'form' => [
                'create' => [
                    'title' => 'Dodaj'
                ],
                'edit' => [
                    'Edytuj'
                ],
                'name' => 'Nazwa',
                'related_collections' => 'Powiązane zbiory',
                'basic_processing' => 'Podstawy przetwarzania',
                'status' => 'Status'
            ]
        ],
        'data_retention' => [
            'title' => 'Retencje danych',
            'form' => [
                'create' => [
                    'title' => 'Dodaj'
                ],
                'edit' => [
                    'title' => 'Edytuj'
                ],
                'name' => 'Nazwa',
                'status' => 'Status',
                'count' => 'Ilość',
                'unit_day' => 'Dzień',
                'unit_month' => 'Miesiąc',
                'unit_year' => 'Rok',
            ]
        ]
    ],
    'processing_areas' => [
        'title' => 'Obszary przetwarzania',
        'form' => [
            'create' => [
                'title' => 'Dodaj obszar'
            ],
            'edit' => [
                'title' => 'Edytuj obszar'
            ]
        ]
    ],
    'trainings' => [
        'title' => 'Szkolenia',
        'tests' => [
            'title' => 'Testy'
        ]
    ]
];
