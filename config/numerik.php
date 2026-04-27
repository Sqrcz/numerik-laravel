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
        'pesel' => true,
        'nip'   => true,
        'regon' => true,
        'krs'   => true,
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
