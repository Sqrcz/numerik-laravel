<?php

declare(strict_types=1);

return [
    // Personal

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

    'id_card' => [
        'default'            => 'The :attribute is not a valid Polish ID card number.',
        'invalid_length'     => 'Identity card number must be exactly 9 characters.',
        'invalid_characters' => 'The :attribute contains invalid characters.',
        'invalid_format'     => 'The :attribute series cannot contain the letters O or Q.',
        'invalid_checksum'   => 'The :attribute checksum digit is incorrect.',
    ],

    'passport' => [
        'default'            => 'The :attribute is not a valid Polish passport number.',
        'invalid_length'     => 'Passport number must be exactly 9 characters.',
        'invalid_characters' => 'The :attribute contains invalid characters.',
        'invalid_checksum'   => 'The :attribute checksum digit is incorrect.',
    ],

    // Tax & Business

    'nip' => [
        'default'            => 'The :attribute is not a valid NIP number.',
        'invalid_length'     => 'NIP must be exactly 10 digits.',
        'invalid_characters' => 'The :attribute may only contain digits and hyphens.',
        'invalid_format'     => 'The :attribute tax office code cannot start with 000.',
        'invalid_checksum'   => 'The :attribute checksum digit is incorrect.',
        'all_same_digit'     => 'The :attribute cannot consist of a single repeated digit.',
    ],

    'vat_eu' => [
        'default'            => 'The :attribute is not a valid VAT-EU number.',
        'invalid_length'     => 'VAT-EU number must contain exactly 10 digits after the PL prefix.',
        'invalid_format'     => 'The :attribute must start with the PL country prefix.',
        'invalid_characters' => 'The :attribute may only contain digits after the PL prefix.',
        'invalid_checksum'   => 'The :attribute checksum digit is incorrect.',
        'all_same_digit'     => 'The :attribute cannot consist of a single repeated digit.',
    ],

    'regon' => 'The :attribute is not a valid REGON number.',

    'krs' => [
        'default'            => 'The :attribute is not a valid KRS number.',
        'invalid_length'     => 'KRS must be between 1 and 10 digits.',
        'invalid_characters' => 'The :attribute may only contain digits.',
        'all_zeros'          => 'The :attribute cannot be all zeros.',
        'all_same_digit'     => 'The :attribute cannot consist of a single repeated digit.',
    ],

    // Banking

    'nrb' => [
        'default'            => 'The :attribute is not a valid NRB account number.',
        'invalid_length'     => 'NRB must be exactly 26 digits.',
        'invalid_characters' => 'The :attribute may only contain digits.',
        'invalid_checksum'   => 'The :attribute checksum (MOD-97) is incorrect.',
    ],

    'iban' => [
        'default'            => 'The :attribute is not a valid Polish IBAN.',
        'invalid_length'     => 'IBAN must contain exactly 26 digits after the PL prefix.',
        'invalid_format'     => 'The :attribute must start with the PL country prefix.',
        'invalid_characters' => 'The :attribute may only contain digits after the PL prefix.',
        'invalid_checksum'   => 'The :attribute checksum is incorrect.',
    ],
];
