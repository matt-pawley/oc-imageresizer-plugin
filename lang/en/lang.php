<?php

return [
    'plugin' => [
        'name' => 'Image Resizer',
        'description' => 'Provides Twig filter to resize images on the fly.'
    ],
    'settings' => [
        'label' => 'Image Resizer Settings',
        'description' => 'Configure Image Resizer Settings',
        'not_found_image' => 'Not Found Image'
    ],
    'permission' => [
        'tab' => 'Image Resizer',
        'label' => 'Manage Settings'
    ]
];
