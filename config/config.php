<?php

declare(strict_types=1);

return [
    'slack' => [
        'webhooks' => [
            'channel' => getenv('SLACK_CHANNEL_WEBHOOK')
        ]
    ],
    'sentry' => [
        'dsn' => getenv('SENTRY_DSN'),
        'environment' => getenv('ENVIRONMENT'),
    ],
];
