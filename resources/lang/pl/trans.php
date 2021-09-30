<?php

return [
    'actions' => [
        'login' => 'logowanie',
        'register' => 'rejestracja',
        'logout' => 'wylogowanie',
        'activate_account' => 'aktywacja konta',
        'deleted' => 'usunięcie',
        'created' => 'utworzenie',
        'updated' => 'edycja'
    ],
    'no_data' => 'Brak danych do wyświetlenia',
    'logout' => 'Wyloguj się',
    'save' => 'Zapisz',
    'roles' => [
        \App\Helpers\Role::$role["ADMIN"] => 'Administrator',
        \App\Helpers\Role::$role['EMPLOYEE'] => 'Pracownik',
        \App\Helpers\Role::$role['INSPECTOR'] => 'Inspektor'
    ],
    'select' => 'Wybierz',
    'cancel' => 'Anuluj',
    'author_types' => [
        'employee' => 'Pracownik',
        'subcontractor' => 'Podwykonawca',
        'media' => 'Media',
        'business_partner' => 'Partner biznesoowy',
        'third_party' => 'Osoba trzecia'
    ]
];
