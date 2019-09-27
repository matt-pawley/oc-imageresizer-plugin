<?php

return [
    'plugin' => [
        'name' => 'Image Resizer',
        'description' => '提供图片大小条这个的 Twig filter。'
    ],
    'settings' => [
        'label' => 'Image Resizer 设置',
        'description' => '配置图片大小调节设置',
        'tab_default' => '默认',
        'tab_advanced' => '高级',
        'not_found_image_label' => '未找到图片',
        'not_found_image_comment' => '在图片不存在时展示一个自定义的图片。',
        'default_mode_label' => '默认模式',
        'default_mode_comment' => '图像应该如何与尺寸匹配。',
        'default_offset_x_label' => '默认 X 轴偏移量',
        'default_offset_x_comment' => '调整大小时垂直方向上的偏移量。',
        'default_offset_y_label' => '默认 Y 轴偏移量',
        'default_offset_y_comment' => '调整大小时垂直方向上的偏移量。',
        'default_extension_label' => '默认扩展名',
        'default_extension_comment' => '返回的图片的扩展名。',
        'default_quality_label' => '默认质量',
        'default_quality_comment' => '图片压缩质量（需要清空缓存）。',
        'default_sharpen_label' => '默认锐化程度',
        'default_sharpen_comment' => '在 0 - 100 范围内锐化图片（需要清空缓存）。',
        'tinypng_hint' => '要申请自己的 <a href="http://tinypng.com" target="_blank">TinyPNG</a> 开发者 key, 请访问 <a href="https://tinypng.com/developers" target="_blank">https://tinypng.com/developers</a>。输入你的邮箱地址，一个你开发者 key 的链接将会通过邮件发送给你。每个月的前 500 次压缩免费，压缩后的图片会缓存下来，用以减少请求次数，这对于大部分网站已经足够了。建议尽量减少请求数量，仅在生产服务器上启用此设置。',
        'enable_tinypng_label' => '使用 TinyPNG 压缩图片',
        'enable_tinypng_comment' => '提供通过 tinypng.com API 来减少文件体积的能力',
        'tinypng_developer_key_label' => '开发者 Key',
        'tinypng_developer_key_comment' => '要了解如何生成此 Key，请查看上面的提示',
        'auto' => 'Auto',
        'mode_exact' => 'Exact',
        'mode_portrait' => 'Portrait',
        'mode_landscape' => 'Landscape',
        'mode_crop' => 'Crop',
        'tinypng_invalid_key' => '输入的 tinypng 密钥无法验证，请检查密钥并重试',
        'tinypng_compressed_images' => 'Compressed Images',
        'tinypng_remaining_compressions' => 'Remaining Free Compressions',
        'tinypng_days_until_reset' => 'Days until reset'
    ],
    'permission' => [
        'tab' => 'Image Resizer',
        'label' => '管理设置'
    ]
];
