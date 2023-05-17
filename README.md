# Kiwiziz

### Table des matière / Table of contents
1. [Guide d'installation (&#x1F1EB;&#x1F1F7;)](#guide-dinstallation)
    1. [Prérequis](#prérequis)
    2. [Configuration](#configuration)
    3. [Lancement](#lancement)
2. [Installation guide (&#x1F1EC;&#x1F1E7;)](#installation-guide)
    1. [Prerequisites](#prerequisites)
    2. [Set-up](#set-up)
    3. [Start-up](#start-up)

---

## Guide d'installation

### Prérequis

Vous devez avoir [php](https://www.php.net/downloads) (version 8 ou plus récente), [symfony](https://symfony.com/download), [composer](https://getcomposer.org/download/) et [npm](https://www.npmjs.com/). Pour gérer vos installations de npm vous pouvez utiliser [nvm for windows](https://github.com/coreybutler/nvm-windows)

### Configuration

* Ajoutez les dossiers d'installation de php, symfony et npm à la variable d'environnement `PATH`.

* Naviguez jusqu'à la racine du projet kiwiziz :
    ```sh
    cd chemin/vers/kiwiziz
    ```

* Installez les dépendances grâce aux commandes :
    ```sh
    composer install
    npm install
    ```
    
### Lancement

* Pour lancer le projet, exécutez la commande
    ```sh
    npm run watch
    ```
* Dans un autre terminal, naviguez jusqu'à l'emplacement de la racine du projet kiwiziz et exécutez la commande :
    ```sh
    symfony server:start
    ```

* Accédez au site web à l'adresse `localhost:8000`.

---

## Installation guide

### Prerequisites

You must have [php](https://www.php.net/downloads) (version 8 or higher), [symfony](https://symfony.com/download), [composer](https://getcomposer.org/download/) and [npm](https://www.npmjs.com/). You may use [nvm for windows](https://github.com/coreybutler/nvm-windows) to manage your npm installations.

### Set-up

* Add your php, symfony and npm installation folder to your `PATH` environment variable.

* Go to the root of the kiwiziz directory:
    ```sh
    cd path/to/kiwiziz
    ```

* Install dependencies:
    ```sh
    composer install
    npm install
    ```

### Start-up

* To start the project:
    ```sh
    npm run watch
    ```
    
* In another terminal window, run:
    ```sh
    symfony server:start
    ```
    
* Acces the website at `localhost:8000`.
