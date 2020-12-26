<?php

function validateInput(array $input): array
{
    $nameIsPresent            = isset($input['name']);

    $emailIsPresentAndValid   = isset($input['email'])
        && filter_var($input['email'], FILTER_VALIDATE_EMAIL);

    $ageIsPresentAndIsNumeric = isset($input['age'])
        && is_numeric($input['age'])
        && $input['age'] > 0;

    $ipIsPresentAndValid      = isset($input['ip'])
        && filter_var($input['ip'], FILTER_VALIDATE_IP);

    return [
        'name'  => $nameIsPresent ? 'valid' : 'invalid',
        'email' => $emailIsPresentAndValid ? 'valid' : 'invalid',
        'age'   => $ageIsPresentAndIsNumeric ? 'valid' : 'invalid',
        'ip'    => $ipIsPresentAndValid ? 'valid' : 'invalid',
    ];
}

$input = [
    'name'  => 'First Last',
    'email' => 'valid@domain.tld',
    'age'   => '21',
    'ip'    => '127.0.0.1'
];

print_r(validateInput($input));
// Array
// (
//     [name] => valid
//     [email] => valid
//     [age] => valid
//     [ip] => valid
// )

unset($input['name']);
$input['email'] = 'invalid email';
$input['ip']    = '127001';

print_r(validateInput($input));
// Array
// (
//     [name] => invalid
//     [email] => invalid
//     [age] => valid
//     [ip] => invalid
// )
