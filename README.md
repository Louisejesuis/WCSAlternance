# WildCiné
Projet de

## Pré-requis
- [Composer](https://getcomposer.org/download/) (Avec `--install-dir` et `--filename`)
- [Node.js et NPM](https://nodejs.org/en/) (Ou [via le gestionnaire de paquets](https://nodejs.org/en/download/package-manager/#debian-and-ubuntu-based-linux-distributions))
- yarn
Versions attendues:
    - PHP >= 7.1
    - NPM >= 6.1.0
    - Node.js >= 10.4.1

> Vérifiez que tout est bien installé en saisissant dans votre terminal `php -v`, `composer about`, `npm -v` puis `node -v`, les commandes doivent vous retourner les bonnes versions.

## Installation
1. Cloner le dépôt puis se déplacer dedans
    - `git clone https://github.com/Louisejesuis/WCSAlternance/` && `cd WCSAlternance`
2. Installer les dépendances via composer, pendant cette étape, il vous sera demander de configurer le projet.
    - `composer install`
3. Installer les dépendances via NPM.
    - `npm install`
4. Construire les assets avec NPM.
    - `yarn`
5. Installer la base de données
6. Démarrer le serveur PHP.
    - `php bin/console server:run`

## Installer la base de données
```
$ php bin/console doctrine:database:create
$ php bin/console doctrine:schema:update -f
$ php bin/console doctrine:fixtures:load
```

## Développeurs
* Louisejesuis - [Github](https://github.com/Louisejesuis)
