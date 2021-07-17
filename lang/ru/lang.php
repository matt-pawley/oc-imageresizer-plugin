<?php


return [
    'plugin' => [
        'name' => 'Рерайзер изображений',
        'description' => 'Добавляет twig фильтр рерайза изображений на лету.'
    ],
    'settings' => [
        'label' => 'Рерайзер изображений',
        'description' => 'Конфигурация рерайзера',
        'tab_default' => 'Основное',
        'tab_advanced' => 'Дополнительно',
        'not_found_image_label' => 'Изображение не найдено',
        'not_found_image_comment' => 'Выберите какую картинку необходимо отобразить, если изрбражение не найдено',
        'default_mode_label' => 'Режим обрезки по умолчанию',
        'default_mode_comment' => 'Влияет на то как будет обрезано изображение.',
        'default_offset_x_label' => 'Смещение по умолчанию - X',
        'default_offset_x_comment' => 'Смещение обрезки по горизонтали.',
        'default_offset_y_label' => 'Смещение по умолчанию - Y',
        'default_offset_y_comment' => 'Смещение обрезки по вертикали.',
        'default_extension_label' => 'Формат изображения по умолчанию',
        'default_extension_comment' => 'Формат изображения, который необходимо вернуть после обрезки.',
        'default_quality_label' => 'Качество по умолчанию',
        'default_quality_comment' => 'Величина сжатия от 0 до 100 (необходима очистка кеша).',
        'default_sharpen_label' => 'Резкость по умолчанию',
        'default_sharpen_comment' => 'Величина резкости от 0 до 100 (необходима очистка кеша).',
        'tinypng_hint' => 'Чтобы получить ключ разработчика для <a href="http://tinypng.com" target="_blank">TinyPNG</a>, посетите <a href="https://tinypng.com/developers" target = "_blank"> https://tinypng.com/developers</a> и введите свой адрес электронной почты. Вам должны отправить API ключ. Первые 500 сжатий в месяц бесплатны, сжатые изображения кэшируются, чтобы уменьшить количество запросов, для большинства сайтов этого будет достаточно. Рекомендуется свести количество запросов к минимуму, включайте этот параметр только на боевых серверах. ',
        'enable_tinypng_label' => 'Сжатие изображений через TinyPNG',
        'enable_tinypng_comment' => 'Возможность сжимать изображения через tinypng.com API.',
        'tinypng_developer_key_label' => 'API ключ',
        'tinypng_developer_key_comment' => 'Подробнее о том как получить ключ, смотрите выше.',
        'auto' => 'Автоматически',
        'mode_exact' => 'Точный (exact)',
        'mode_portrait' => 'Портрет (portrait)',
        'mode_landscape' => 'Пейзаж (landscape)',
        'mode_crop' => 'Обрезка (crop)',
        'tinypng_invalid_key' => 'Введенный ключ tinypng не может быть подтвержден, проверьте ключ и повторите попытку..',
        'tinypng_compressed_images' => 'Сжато изображений',
        'tinypng_remaining_compressions' => 'Осталось сжатий',
        'tinypng_days_until_reset' => 'Дней до обнуления кол. сжатий'
    ],
    'permission' => [
        'tab' => 'Рерайзер изображений',
        'label' => 'Управление настройками рерайзера'
    ]
];
