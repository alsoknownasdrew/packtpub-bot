<?php

declare(strict_types=1);

return [
    'sentry' => [
        'dsn' => getenv('SENTRY_DSN'),
        'environment' => getenv('ENVIRONMENT'),
    ],
];