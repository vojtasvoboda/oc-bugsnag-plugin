<?php

return [
    'plugin' => [
        'name' => 'Bugsnag support for Error Logger',
        'description' => 'Extend Error Logger to support Bugsnag',
    ],
    'tab' => [
        'name' => 'Bugsnag',
    ],
    'fields' => [
        'bugsnag_enabled' => [
            'label' => 'Enable Bugsnag tracking',
        ],
        'bugsnag_api_key' => [
            'label' => 'API Key',
            'comment' => 'For your own API key continue to https://bugsnag.com/',
        ],
    ],
];
