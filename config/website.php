<?php

return [
    'feature' => [
        'email_verify' => true,
        '2fa' => false,
    ],
    'debug' => [
        'debug_mode' => false,
        'level' => [
            'error' => 4,
            'warning' => 3,
            'info' => 2,
            'log' => 1,
        ],
        'current_level' => 'warning',
        'log_cleanup' => 30, // 0 never cleanup
        'log_file_name' => date('Y-m-d') . '.log',
    ],
    'setting' => [
        'restrict_multiple_logins' => false,
    ],
];