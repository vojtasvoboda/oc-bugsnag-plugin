<?php

return [
    'plugin' => [
        'name' => 'Bugsnag Ünterstützung für Event-Log',
        'description' => 'Sendet Event-Logs zusätzlich an Bugsnag.',
    ],
    'tab' => [
        'name' => 'Bugsnag',
    ],
    'fields' => [
        'bugsnag_enabled' => [
            'label' => 'Bugsnag-Tracking aktivieren',
        ],
        'bugsnag_api_key' => [
            'label' => 'API Schlüssel',
            'comment' => 'Um deinen eigenen API Schlüssel zu erstellen, gehe auf https://bugsnag.com/',
        ],
    ],
];
