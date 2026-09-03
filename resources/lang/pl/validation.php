<?php

declare(strict_types=1);

return [
    // Personal

    'pesel' => [
        'default'            => 'Pole :attribute nie jest prawidłowym numerem PESEL.',
        'invalid_length'     => 'Pole :attribute musi składać się dokładnie z 11 cyfr.',
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

    'id_card' => [
        'default'            => 'Pole :attribute nie jest prawidłowym numerem dowodu osobistego.',
        'invalid_length'     => 'Pole :attribute musi składać się dokładnie z 9 znaków.',
        'invalid_characters' => 'Pole :attribute zawiera niedozwolone znaki.',
        'invalid_format'     => 'Seria w polu :attribute nie może zawierać liter O ani Q.',
        'invalid_checksum'   => 'Cyfra kontrolna w polu :attribute jest nieprawidłowa.',
    ],

    'passport' => [
        'default'            => 'Pole :attribute nie jest prawidłowym numerem paszportu.',
        'invalid_length'     => 'Pole :attribute musi składać się dokładnie z 9 znaków.',
        'invalid_characters' => 'Pole :attribute zawiera niedozwolone znaki.',
        'invalid_checksum'   => 'Cyfra kontrolna w polu :attribute jest nieprawidłowa.',
    ],

    // Tax & Business

    'nip' => [
        'default'            => 'Pole :attribute nie jest prawidłowym numerem NIP.',
        'invalid_length'     => 'Pole :attribute musi składać się dokładnie z 10 cyfr.',
        'invalid_characters' => 'Pole :attribute może zawierać wyłącznie cyfry i myślniki.',
        'invalid_format'     => 'Kod urzędu skarbowego w polu :attribute nie może zaczynać się od 000.',
        'invalid_checksum'   => 'Cyfra kontrolna w polu :attribute jest nieprawidłowa.',
        'all_same_digit'     => 'Pole :attribute nie może składać się z jednej powtarzającej się cyfry.',
    ],

    'vat_eu' => [
        'default'            => 'Pole :attribute nie jest prawidłowym numerem VAT-EU.',
        'invalid_length'     => 'Pole :attribute musi zawierać dokładnie 10 cyfr po prefiksie PL.',
        'invalid_format'     => 'Pole :attribute musi zaczynać się od prefiksu kraju PL.',
        'invalid_characters' => 'Pole :attribute może zawierać wyłącznie cyfry po prefiksie PL.',
        'invalid_checksum'   => 'Cyfra kontrolna w polu :attribute jest nieprawidłowa.',
        'all_same_digit'     => 'Pole :attribute nie może składać się z jednej powtarzającej się cyfry.',
    ],

    'regon' => [
        'default'            => 'Pole :attribute nie jest prawidłowym numerem REGON.',
        'invalid_length'     => 'Pole :attribute musi zawierać 9 lub 14 cyfr.',
        'invalid_characters' => 'Pole :attribute może zawierać wyłącznie cyfry.',
        'invalid_checksum'   => 'Cyfra kontrolna w polu :attribute jest nieprawidłowa.',
    ],

    'krs' => [
        'default'            => 'Pole :attribute nie jest prawidłowym numerem KRS.',
        'invalid_length'     => 'Pole :attribute musi zawierać od 1 do 10 cyfr.',
        'invalid_characters' => 'Pole :attribute może zawierać wyłącznie cyfry.',
        'all_zeros'          => 'Pole :attribute nie może składać się wyłącznie z zer.',
        'all_same_digit'     => 'Pole :attribute nie może składać się z jednej powtarzającej się cyfry.',
    ],

    // Banking

    'nrb' => [
        'default'            => 'Pole :attribute nie jest prawidłowym numerem rachunku bankowego NRB.',
        'invalid_length'     => 'Pole :attribute musi składać się dokładnie z 26 cyfr.',
        'invalid_characters' => 'Pole :attribute może zawierać wyłącznie cyfry.',
        'invalid_checksum'   => 'Suma kontrolna (MOD-97) w polu :attribute jest nieprawidłowa.',
    ],

    'iban' => [
        'default'            => 'Pole :attribute nie jest prawidłowym polskim numerem IBAN.',
        'invalid_length'     => 'Pole :attribute musi zawierać dokładnie 26 cyfr po prefiksie PL.',
        'invalid_format'     => 'Pole :attribute musi zaczynać się od prefiksu kraju PL.',
        'invalid_characters' => 'Pole :attribute może zawierać wyłącznie cyfry po prefiksie PL.',
        'invalid_checksum'   => 'Suma kontrolna w polu :attribute jest nieprawidłowa.',
    ],
];
