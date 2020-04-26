# INC

Ce répertoire contient les fonctions du thème.

Elles sont séparées dans plusieurs fichiers pour une meilleure lisibilité :

- `theme-acf.php` : contient les actions et filtres liés à ACF
- `theme-sub-actions.php` : contient les actions globales du thème
- `theme-actions.php` : contient l'appel aux actions globales du thème. Plus d'information [ici](https://developer.wordpress.org/reference/functions/add_action/)
- `theme-sub-filters.php` : contient les filtres globaux du thème
- `theme-filters.php` : contient l'appel aux filtres globaux du thème. Plus d'information [ici](https://developer.wordpress.org/reference/functions/add_filter/)
- `theme-size-images.php` : contient les tailles d'images personnalisées. Plus d'information [ici](https://developer.wordpress.org/reference/functions/add_image_size/)
- `theme-functions.php` : contient les fonctions réutilisables dans le thème

Tous ces fichiers sont directement appelés via le fichier `function.php`
