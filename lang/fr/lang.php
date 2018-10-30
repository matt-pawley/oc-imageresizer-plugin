<?php

return [
    'plugin' => [
        'name' => 'Image Resizer',
        'description' => 'Fournit un filtre Twig pour redimensionner les images.'
    ],
    'settings' => [
        'label' => 'Paramètres Image Resizer',
        'description' => 'Configurer les paramètres d\'Image Resizer',
        'tab_default' => 'Réglages généraux',
        'tab_advanced' => 'Réglages avancés',
        'not_found_image_label' => 'Image introuvable',
        'not_found_image_comment' => 'Affiche une image personnalisée si l\'image n\'existe pas.',
        'default_mode_label' => 'Mode par défaut',
        'default_mode_comment' => 'Comment l\'image doit être adaptée aux dimensions.',
        'default_offset_x_label' => 'Décalage par défaut X',
        'default_offset_x_comment' => 'Décalez l\'image redimensionnée horizontalement.',
        'default_offset_y_label' => 'Décalage par défaut Y',
        'default_offset_y_comment' => 'Décalez l\'image redimensionnée verticalement',
        'default_extension_label' => 'Extension par défaut',
        'default_extension_comment' => 'L\'extension de l\'image affiché.',
        'default_quality_label' => 'Qualité par défaut',
        'default_quality_comment' => 'La qualité de la compression (nécessite la suppression du cache).',
        'default_sharpen_label' => 'Accentuage par défaut',
        'default_sharpen_comment' => 'Accentuez l\'image sur une échelle de 0 à 100 (nécessite la suppression du cache).',
        'tinypng_hint' => 'Pour obtenir votre clé de développeur pour <a href="https://tinypng.com" target="_blank">TinyPNG</a>, consultez la page <a href="https://tinypng.com/developers" target="_blank">https://tinypng.com/developers</a>. Entrez votre adresse e-mail et un lien vers votre clé développeur vous sera envoyé par courriel. Les 500 premières compressions par mois sont gratuites, les images compressées sont mises en cache afin de réduire le nombre de demandes. Cela suffira pour la plupart des sites. Il est recommandé de limiter le nombre de demandes au minimum afin d\'activer ce paramètre uniquement sur les serveurs de production.',
        'enable_tinypng_label' => 'Compresser les images avec TinyPNG',
        'enable_tinypng_comment' => 'Ajoute la possibilité de compresser des images via l\'API tinypng.com afin de réduire la taille du fichier.',
        'tinypng_developer_key_label' => 'Clé de développeur',
        'tinypng_developer_key_comment' => 'Voir ci-dessus pour savoir comment obtenir la clé.',
        'auto' => 'Auto',
        'mode_exact' => 'Exact',
        'mode_portrait' => 'Portrait',
        'mode_landscape' => 'Paysage',
        'mode_crop' => 'Rogner',
        'tinypng_invalid_key' => 'La clé TinyPNG saisie n\'a pas pu être validée. Veuillez vérifier la clé et réessayer.',
        'tinypng_compressed_images' => 'Images compressées',
        'tinypng_remaining_compressions' => 'Compressions gratuites restantes',
        'tinypng_days_until_reset' => 'Jours jusqu\'à la réinitialisation'
    ],
    'permission' => [
        'tab' => 'Image Resizer',
        'label' => 'Gérer les paramètres'
    ]
];
