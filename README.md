# Kope alias Ventalis

## Description

SIte E commerce en cours pour le projet CDA 

## Prérequis

Avant de déployer localement, assurez-vous d'avoir installé les outils suivants :

- PHP
- Composer
- Symfony CLI
- ...

## Installation

1. Clonez le dépôt :

    ```bash
    git clone https://github.com/St-el-a-lisa/kope.git
    ```

2. Installez les dépendances avec Composer :

    ```bash
    composer install
    ```

3. Configurez votre fichier d'environnement (.env) avec les paramètres nécessaires.

4. Créez la base de données :

    ```bash
    php bin/console doctrine:database:create
    ```

5. Appliquez les migrations :

    ```bash
    php bin/console doctrine:migrations:migrate
    ```

## Démarrage du Serveur

Lancez le serveur Symfony avec la commande :

```bash
symfony server:start
# kope
