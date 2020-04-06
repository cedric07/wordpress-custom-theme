# Fonctionnalités
- Grille et reboot Bootstrap 4
- Starter kit
- Compilation des assets (CSS, JS, images) avec Gulp
    - Compilation des fichiers .scss
    - Concaténation des fichiers .css et .js
    - JSHint
    - Autoprefixer
    - Sourcemaps
    - Minification des images du thème
    - Notifications
- Zone de widget
- Emplacement de menu
- Gestion des tailles d'images personnalisées
- Pagination
- Template de page
- Bloc ACF Gutenberg
- Options du thème avec ACF et création automatique des groupes de champs associés
- Synchronisation automatique des champs ACF
- Fonctions utiles

# Mise en place du thème

### 1) Renommer le thème et le Text Domain `your_text_domain`

### 2) Installer les composants et dépendances :

```sh
yarn install
```

### 3) Compilation et concaténation des fichiers :

```sh
yarn build
```

Pour le watch :

```sh
yarn watch
```

### Starter kit :
https://your-url.local/wp-content/themes/your_theme/src/library/library.html

# Gestion des dépendances
https://classic.yarnpkg.com/fr/docs/cli/add

### Pour ajouter une dépendance :

```sh
yarn add [package-name]
```

### Pour ajouter une dépendance de développement :

```sh
yarn add [package-name] --dev
```
