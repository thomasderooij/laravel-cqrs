<?php

return [
    'command' => [
        'directory' => env('CQRS_COMMAND_DIRECTORY', 'Cqrs/Commands'),
    ],
    'query' => [
        'directory' => env('CQRS_QUERY_DIRECTORY', 'Cqrs/Queries'),
    ],
];
