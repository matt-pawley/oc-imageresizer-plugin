<?php

return [
    'plugin' => [
        'name' => 'Image Resizer',
        'description' => 'Provides Twig filter to resize images on the fly.'
    ],
    'settings' => [
        'label' => 'Image Resizer Settings',
        'description' => 'Configure Image Resizer Settings',
        'not_found_image_label' => 'Not Found Image',
        'not_found_image_comment' => 'Displays a customizable image if the image doesn\'t exist.',
        'default_mode_label' => 'Default mode',
        'default_mode_comment' => 'How the image should be fitted to dimensions.',
        'default_offset_label' => 'Default offset',
        'default_offset_comment' => 'Offset the resized image.',
        'default_extension_label' => 'Default extension',
        'default_extension_comment' => 'The extension on the image to return.',
        'default_quality_label' => 'Default quality',
        'default_quality_comment' => 'The quality of compression (requires cache clear).',
        'default_sharpen_label' => 'Default sharpen',
        'default_sharpen_comment' => 'Sharpen the image across a scale of 0 - 100 (requires cache clear).',
        'auto' => 'Auto',
        'mode_exact' => 'Exact',
        'mode_portrait' => 'Portrait',
        'mode_landscape' => 'Landscape',
        'mode_crop' => 'Crop'
    ],
    'permission' => [
        'tab' => 'Image Resizer',
        'label' => 'Manage Settings'
    ]
];
