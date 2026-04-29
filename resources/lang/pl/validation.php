<?php

declare(strict_types=1);

return [
    'nip' => [
        'default'            => 'Pole :attribute nie jest prawidłowym numerem NIP.',
        'invalid_length'     => 'NIP musi składać się dokładnie z 10 cyfr.',
        'invalid_characters' => 'Pole :attribute może zawierać wyłącznie cyfry i myślniki.',
        'invalid_format'     => 'Kod urzędu skarbowego w polu :attribute nie może zaczynać się od 000.',
        'invalid_checksum'   => 'Cyfra kontrolna w polu :attribute jest nieprawidłowa.',
        'all_same_digit'     => 'Pole :attribute nie może składać się z jednej powtarzającej się cyfry.',
    ],

    'krs' => [
        'default'            => 'Pole :attribute nie jest prawidłowym numerem KRS.',
        'invalid_length'     => 'KRS musi zawierać od 1 do 10 cyfr.',
        'invalid_characters' => 'Pole :attribute może zawierać wyłącznie cyfry.',
        'all_zeros'          => 'Pole :attribute nie może składać się wyłącznie z zer.',
        'all_same_digit'     => 'Pole :attribute nie może składać się z jednej powtarzającej się cyfry.',
    ],

    'pesel' => [
        'default'            => 'Pole :attribute nie jest prawidłowym numerem PESEL.',
        'invalid_length'     => 'PESEL musi składać się dokładnie z 11 cyfr.',
        'invalid_characters' => 'Pole :attribute może zawierać wyłącznie cyfry.',
        'invalid_month'      => 'Pole :attribute zawiera nieprawidłowe kodowanie miesiąca.',
        'invalid_date'       => 'Pole :attribute zawiera nieprawidłową datę.',
        'invalid_checksum'   => 'Cyfra kontrolna w polu :attribute jest nieprawidłowa.',
        'future_date'        => 'Pole :attribute musi należeć do osoby urodzonej w przeszłości.',
        'all_same_digit'     => 'Pole :attribute nie może składać się z jednej powtarzającej się cyfry.',
    ],

    'pesel_gender'      => 'Pole :attribute nie odpowiada oczekiwanej płci.',
    'pesel_born_before' => 'Pole :attribute musi należeć do osoby urodzonej przed :date.',
    'pesel_born_after'  => 'Pole :attribute musi należeć do osoby urodzonej po :date.',

    'regon' => 'Pole :attribute nie jest prawidłowym numerem REGON.',
];
