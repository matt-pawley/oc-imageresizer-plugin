<?php

return [
    'plugin' => [
        'name' => 'Képméretezés',
        'description' => 'Képek dinamikus átméretezése és módosítása.'
    ],
    'settings' => [
        'label' => 'Képméretezés',
        'description' => 'Szolgáltatáshoz tartozó beállítások',
        'tab_default'   => 'Alapértékek',
        'tab_advanced'   => 'Fejlett',
        'not_found_image_label' => 'Helyettesítő kép',
        'not_found_image_comment' => 'Ha nem létezik az adott kép, akkor ez a kép jelenik meg.',
        'default_mode_label' => 'Alapértelmezett mód',
        'default_mode_comment' => 'A kép arányának meghatározása.',
        'default_offset_x_label' => 'Alapértelmezett X eltolás',
        'default_offset_x_comment' => 'A kép vízszintes eltolásának mértéke képpontban.',
        'default_offset_y_label' => 'Alapértelmezett Y eltolás',
        'default_offset_y_comment' => 'A kép függőleges eltolásának mértéke képpontban.',
        'default_extension_label' => 'Alapértelmezett kiterjesztés',
        'default_extension_comment' => 'A kép kiterjesztésének fajtája.',
        'default_quality_label' => 'Alapértelmezett minőség',
        'default_quality_comment' => 'A kép minőségének mértéke. 0 és 100 közötti érték lehet.',
        'default_sharpen_label' => 'Alapértelmezett élesítés',
        'default_sharpen_comment' => 'A kép élesítésének mértéke. 0 és 100 közötti érték lehet.',
        'tinypng_hint' => 'Ahhoz, hogy a fejlesztő billentyűvel <a href="http://tinypng.com" target="_blank">Tiny PNG</a>, kérlek látogasd <a href="https://tinypng.com/developers/" target="_blank">https://tinypng.com/developers/</a>. Adja meg e-mail címét és egy linket a fejlesztői kulcsot e-mailben küldjük át Önnek. Az első 500 kompressziót egy hónap ingyenes, tömörített képeket tárolt csökkenteni a kérelmek száma, és a legtöbb helyen ez is elég. Javasoljuk, hogy a kérelmek száma a minimálisra, hogy csak engedélyezi ezt a beállítást szerveren.',
        'enable_tinypng_label' => 'Tömöríteni a képeket a tinyPNG',
        'enable_tinypng_comment' => 'Lehetőséget ad az fut png képek révén tinypng.com API csökkenti a fájlméretet',
        'tinypng_developer_key_label' => 'Fejlesztői kulcs',
        'tinypng_developer_key_comment' => 'Lásd fent részleteit, hogyan juthat ilyen',
        'auto' => 'Automatikus',
        'mode_exact' => 'Pontos',
        'mode_portrait' => 'Álló',
        'mode_landscape' => 'Fekvő',
        'mode_crop' => 'Levágott'
    ],
    'permission' => [
        'tab' => 'Képméretezés',
        'label' => 'Beállítások kezelése'
    ]
];
