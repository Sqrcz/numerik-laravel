<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | String-based rule aliases
    |--------------------------------------------------------------------------
    | Set any entry to false to prevent that alias from being registered
    | with the Laravel Validator.
    */
    'rules' => [
        // Personal
        'pesel'    => true,
        'id_card'  => true,
        'passport' => true,

        // Tax & Business
        'nip'      => true,
        'vat_eu'   => true,
        'regon'    => true,
        'krs'      => true,

        // Banking
        'nrb'      => true,
        'iban'     => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Global strict mode
    |--------------------------------------------------------------------------
    | When true, structurally suspicious inputs (e.g. all same digit) are
    | rejected. Override per rule: new PeselRule(strict: false)
    */
    'strict' => true,
];
