<?php

// Configuration file for Real-Time DevOps Pipeline Parser

// Define pipeline stages
$stages = [
    'build' => [
        'commands' => [
            'composer install',
            'npm install',
        ],
        'dependencies' => ['composer.lock', 'package-lock.json'],
    ],
    'test' => [
        'commands' => [
            'phpunit',
            'jest',
        ],
        'dependencies' => ['tests/**/*.php', 'tests/**/*.js'],
    ],
    'deploy' => [
        'commands' => [
            'git push production',
            'ssh production "cd ~/project && npm run deploy"',
        ],
        'dependencies' => ['production'],
    ],
];

// Define pipeline triggers
$triggers = [
    'push' => [
        'branches' => ['master', 'develop'],
        'events' => ['push'],
    ],
    'schedule' => [
        'cron' => '0 0 * * *', // daily at midnight
    ],
];

// Define pipeline parser settings
$parser = [
    'log_level' => 'DEBUG',
    'timeout' => 300, // 5 minutes
    'concurrency' => 5,
];

// Define pipeline notifications
$notifications = [
    'email' => [
        'recipients' => ['devops@example.com'],
        'subject' => 'Pipeline Update: {{ pipeline_name }}',
    ],
    'slack' => [
        'channel' => 'devops-alerts',
        'username' => 'Pipeline Bot',
    ],
];

// Define pipeline storage settings
$storage = [
    'type' => 'sqlite',
    'db_name' => 'pipeline.db',
    'db_username' => 'pipeline_user',
    'db_password' => 'pipeline_password',
];

return [
    'stages' => $stages,
    'triggers' => $triggers,
    'parser' => $parser,
    'notifications' => $notifications,
    'storage' => $storage,
];

?>