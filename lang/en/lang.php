<?php

return [
    'plugin' => [
        'name' => 'Image Resizer',
        'description' => 'Provides Twig filter to resize images on the fly.'
    ],
    'settings' => [
        'label' => 'Image Resizer Settings',
        'description' => 'Configure Image Resizer Settings',
        'tab_default' => 'Defaults',
        'tab_advanced' => 'Advanced',
        'not_found_image_label' => 'Not Found Image',
        'not_found_image_comment' => 'Displays a customizable image if the image doesn\'t exist.',
        'default_mode_label' => 'Default mode',
        'default_mode_comment' => 'How the image should be fitted to dimensions.',
        'default_offset_x_label' => 'Default offset X',
        'default_offset_x_comment' => 'Offset the resized image horizontally.',
        'default_offset_y_label' => 'Default offset Y',
        'default_offset_y_comment' => 'Offset the resized image vertically.',
        'default_extension_label' => 'Default extension',
        'default_extension_comment' => 'The extension on the image to return.',
        'default_quality_label' => 'Default quality',
        'default_quality_comment' => 'The quality of compression (requires cache clear).',
        'default_sharpen_label' => 'Default sharpen',
        'default_sharpen_comment' => 'Sharpen the image across a scale of 0 - 100 (requires cache clear).',
        'tinypng_hint' => 'To obtain your developer key for <a href="http://tinypng.com" target="_blank">TinyPNG</a>, please visit <a href="https://tinypng.com/developers" target="_blank">https://tinypng.com/developers</a>. Enter your email address and a link to your developer key will be emailed across to you. The first 500 compressions a month are free, compressed images are cached to reduce the number of requests and for most sites this will suffice. It is recommended to keep the number of requests to a minimum, to only enable this setting on production servers.',
        'enable_tinypng_label' => 'Compress images with TinyPNG',
        'enable_tinypng_comment' => 'Adds the ability to run images through tinypng.com API to reduce filesize',
        'tinypng_developer_key_label' => 'Developer Key',
        'tinypng_developer_key_comment' => 'See above for details of how to obtain this',
        'auto' => 'Auto',
        'mode_exact' => 'Exact',
        'mode_portrait' => 'Portrait',
        'mode_landscape' => 'Landscape',
        'mode_crop' => 'Crop',
        'tinypng_invalid_key' => 'The tinypng key entered could not be validated, please check the key and try again.',
        'tinypng_compressed_images' => 'Compressed Images',
        'tinypng_remaining_compressions' => 'Remaining Free Compressions',
        'tinypng_days_until_reset' => 'Days until reset'
    ],
    'permission' => [
        'tab' => 'Image Resizer',
        'label' => 'Manage Settings'
    ]
];
