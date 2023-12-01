<?php

return [
    'settings' => [
        
        'displayErrorDetails' => true,
        'addContentLengthHeader' => false,
        
        // Renderer settings
        'renderer' => [
            'debug' => true,
            'template_path' => __DIR__ . '/../templates/',
            'cache_path' => __DIR__ . '/../templates/cache/'
        ]
        
    ]
];
