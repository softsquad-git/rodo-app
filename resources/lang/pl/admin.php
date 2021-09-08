<?php

return [
    'title' => 'Administrator',
    'settings' => [
        'title' => 'System',
        'avatar' => 'Zdjęcie profilowe',
        'change_avatar' => 'Zmień zdjęcie profilowe',
        'basic_data' => 'Dane podstawowe'
    ],
    'logs' => [
        'title' => 'Rejestr zdarzeń',
        'items' => [
            'ip' => 'Adres IP',
            'user' => 'Użytkownik',
            'action' => 'Akcja',
            'resource' => 'Element',
            'created_at' => 'Czas'
        ],

    ],
    'users' => [
        'title' => 'Użytkownicy',
        'items' => [
            'email'  =>'E-mail',
            'name' => 'Imię i nazwisko',
            'role' => 'Rola'
        ],
        'form' => [
            'create' => [
                'title' => 'Dodaj użytkownika'
            ],
            'update' => [
                'title' => 'Zmień dane użytkownika'
            ],
            'first_name' => 'Imię',
            'last_name' => 'Nazwisko',
            'email' => 'E-mail',
            'type_account' => 'Rodzaj konta',
            'password' => 'Hasło'
        ]
    ],
    'clients' => [
        'index' => 'Klienci',
        'form' => [
            'create' => [
                'title' => 'Dodaj klienta'
            ],
            'update' => [
                'title' => 'Zmień dane klienta'
            ],
            'nip' => 'NIP',
            'krs' => 'KRS',
            'regon' => 'Regon',
            'name' => 'Nazwa',
            'short' => 'Skrót',
            'type' => 'Typ',
            'status' => 'Status',
            'address' => 'Adres',
            'contact' => [
                'management' => 'Zarząd',
                'secretariat' => 'Sekretariat',
                'bookkeeping' => 'Księgowość'
            ],
            'phone' => 'Telefon',
            'email' => 'E-mail',
            'data_contact' => 'Dane kontaktowe',
            'data_smtp' => 'Konfiguracja SMTP',
            'smtp' => [
                'host' => 'Host',
                'port' => 'Port',
                'username' => 'Nazwa użytkownika',
                'password' => 'Hasło',
                'encryption' => 'Szyfrowanie'
            ],
        ],
        'items' => [
            'number' => 'Numer',
            'short' => 'Skrót',
            'name' => 'Nazwa',
            'type' => 'Typ',
            'status' => 'Status'
        ]
    ]
];
