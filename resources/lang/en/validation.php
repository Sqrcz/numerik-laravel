<?php

declare(strict_types=1);

return [
    'nip' => [
        'default'            => 'The :attribute is not a valid NIP number.',
        'invalid_length'     => 'NIP must be exactly 10 digits.',
        'invalid_characters' => 'The :attribute may only contain digits and hyphens.',
        'invalid_format'     => 'The :attribute tax office code cannot start with 000.',
        'invalid_checksum'   => 'The :attribute checksum digit is incorrect.',
        'all_same_digit'     => 'The :attribute cannot consist of a single repeated digit.',
    ],

    'krs' => [
        'default'            => 'The :attribute is not a valid KRS number.',
        'invalid_length'     => 'KRS must be between 1 and 10 digits.',
        'invalid_characters' => 'The :attribute may only contain digits.',
        'all_zeros'          => 'The :attribute cannot be all zeros.',
        'all_same_digit'     => 'The :attribute cannot consist of a single repeated digit.',
    ],

    'pesel' => [
        'default'            => 'The :attribute is not a valid PESEL number.',
        'invalid_length'     => 'PESEL must be exactly 11 digits.',
        'invalid_characters' => 'The :attribute may only contain digits.',
        'invalid_month'      => 'The :attribute contains an invalid month encoding.',
        'invalid_date'       => 'The :attribute contains an invalid date.',
        'invalid_checksum'   => 'The :attribute checksum digit is incorrect.',
        'future_date'        => 'The :attribute must belong to a person born in the past.',
        'all_same_digit'     => 'The :attribute cannot consist of a single repeated digit.',
    ],

    'pesel_gender'      => 'The :attribute does not match the expected gender.',
    'pesel_born_before' => 'The :attribute must belong to a person born before :date.',
    'pesel_born_after'  => 'The :attribute must belong to a person born after :date.',

    'regon' => 'The :attribute is not a valid REGON number.',
];
