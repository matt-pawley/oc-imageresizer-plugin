<?php

return [
    'plugin' => [
        'name' => 'Képméretezés',
        'description' => 'Képek dinamikus átméretezése és módosítása.'
    ],
    'settings' => [
        'label' => 'Képméretezés',
        'description' => 'Szolgáltatáshoz tartozó beállítások',
        'tab_default' => 'Általános',
        'tab_advanced' => 'Kiegészítők',
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
        'tinypng_hint' => 'A <a href="http://tinypng.com" target="_blank">TinyPNG</a> használatához először regisztráljon a <a href="https://tinypng.com/developers" target="_blank">https://tinypng.com/developers</a> címen. Ezt követően e-mailben fog kapni egy linket, amin keresztül elérheti a személyes fejlesztői kulcsát. Az első 500 tömörítés ingyenes minden hónapban. Javasoljuk, hogy a havi keret túllépésének elkerülése érdekében, csak éles weboldalnál kapcsolja be a szolgáltatást.',
        'enable_tinypng_label' => 'Képek tömörítése a TinyPNG segítségével',
        'enable_tinypng_comment' => 'A png kiterjesztésű képek méretének csökkentése a szolgáltatással használatával.',
        'tinypng_developer_key_label' => 'Fejlesztői kulcs',
        'tinypng_developer_key_comment' => 'A részleteket a fenti leírásban találja.',
        'auto' => 'Automatikus',
        'mode_exact' => 'Pontos',
        'mode_portrait' => 'Álló',
        'mode_landscape' => 'Fekvő',
        'mode_crop' => 'Levágott',
        'tinypng_invalid_key' => 'A megadott tinypng kulcsot nem lehet érvényesíteni. Kérjük ellenőrizze és próbálja újra.',
        'tinypng_compressed_images' => 'Tömörített képek',
        'tinypng_remaining_compressions' => 'Fennmaradó kompresszió',
        'tinypng_days_until_reset' => 'Napok törlésig'
    ],
    'permission' => [
        'tab' => 'Képméretezés',
        'label' => 'Beállítások kezelése'
    ]
];
