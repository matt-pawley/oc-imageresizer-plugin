<?php

return [
    'plugin' => [
        'name' => 'Képméretezés',
        'description' => 'Képek dinamikus átméretezése és módosítása.'
    ],
    'settings' => [
        'label' => 'Képméretezés',
        'description' => 'Szolgáltatáshoz tartozó beállítások',
        'not_found_image_label' => 'Helyettesítő kép',
        'not_found_image_comment' => 'Ha nem létezik az adott kép, akkor ez a kép jelenik meg.',
        'default_mode_label' => 'Alapértelmezett mód',
        'default_mode_comment' => 'A kép arányának meghatározása.',
        'default_offset_x_label' => 'Alapértelmezett eltolás X',
        'default_offset_x_comment' => 'A kép eltolásának mértéke képpontban vízszintesen.',
        'default_offset_y_label' => 'Alapértelmezett eltolás Y',
        'default_offset_y_comment' => 'A kép eltolásának mértéke képpontban függőlegesen.',
        'default_extension_label' => 'Alapértelmezett kiterjesztés',
        'default_extension_comment' => 'A kép kiterjesztésének fajtája.',
        'default_quality_label' => 'Alapértelmezett minőség',
        'default_quality_comment' => 'A kép minőségének mértéke. 0 és 100 között lehet.',
        'default_sharpen_label' => 'Alapértelmezett élesítés',
        'default_sharpen_comment' => 'A kép élesítésének mértéke. 0 és 100 között lehet.',
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
