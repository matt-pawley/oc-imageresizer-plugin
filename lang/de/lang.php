<?php

return [
    'plugin' => [
        'name' => 'Bildskalierung',
        'description' => 'Stellt Twig-Filter zum Skalieren von Bildern bereit.'
    ],
    'settings' => [
        'label' => 'Bildskalierung Einstellungen',
        'description' => 'Einstellungen der Bildskalierung verwalten',
        'tab_default' => 'Vorgaben',
        'tab_advanced' => 'Erweitert',
        'not_found_image_label' => 'Nicht gefunden Bild',
        'not_found_image_comment' => 'Zeigt ein anpassbares Bild an, sollte das Bild nicht existieren.',
        'default_mode_label' => 'Standard Modus',
        'default_mode_comment' => 'Wie soll das Bild skaliert werden.',
        'default_offset_x_label' => 'Standard Abstand X',
        'default_offset_x_comment' => 'Setzt einen horizontalen Abstand.',
        'default_offset_y_label' => 'Standard Abstand Y',
        'default_offset_y_comment' => 'Setzt einen vertikalen Abstand.',
        'default_extension_label' => 'Standard Erweiterung',
        'default_extension_comment' => 'Die Erweiterung des zurückgegebenen Bildes.',
        'default_quality_label' => 'Standard Qualität',
        'default_quality_comment' => 'Die Qualität der Komprimierung (erfordert das Leeren des Chaches).',
        'default_sharpen_label' => 'Standard Schärfung',
        'default_sharpen_comment' => 'Schärft das Bild von 0 - 100 (erfordert das Leeren des Chaches).',
        'tinypng_hint' => 'Um einen Entwickler-Schlüssel für <a href="http://tinypng.com" target="_blank">TinyPNG</a> zu bekommen, bitte <a href="https://tinypng.com/developers" target="_blank">https://tinypng.com/developers</a> besuchen. Mit Angabe der E-Mail Addresse wird ein Link zum Schlüssel gesendet. Die ersten 500 Bilder pro Monat sind gratis, komprimierte Bilder werden gespeichert um die Anfragen zu reduzieren. Für die meisten Seiten reicht dies aus. Es wird geraten dieses Feature nur so wenig wie möglich und nur Live zu benutzen.',
        'enable_tinypng_label' => 'Komprimiere Bilder mit TinyPNG',
        'enable_tinypng_comment' => 'Fügt die Möglichkeit hinzu Bilder mit der tinypng.com API zu komprimieren und so die Dateigröße zu minimieren',
        'tinypng_developer_key_label' => 'Entwickler Schlüssel',
        'tinypng_developer_key_comment' => 'Siehe oben für eine Anleitung zum Erhalt eines Schlüssels',
        'auto' => 'Auto',
        'mode_exact' => 'Exakt',
        'mode_portrait' => 'Hochformat',
        'mode_landscape' => 'Querformat',
        'mode_crop' => 'Abschneiden',
        'tinypng_invalid_key' => 'Der tinypng Schlüssel konnte nicht validiert werden, bitte überprüfen und erneut probieren.',
        'tinypng_compressed_images' => 'Komprimierte Bilder',
        'tinypng_remaining_compressions' => 'Verbleibende kostenlose Komprimierungen',
        'tinypng_days_until_reset' => 'Tage bis zum Reset'
    ],
    'permission' => [
        'tab' => 'Bildskalierung',
        'label' => 'Einstellungen verwalten'
    ]
];
