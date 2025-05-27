## Installation du projet :

### Prérequis :
- PHP >= 8.2
- MySQL >= 8
- node >= 20
- Composer
- CLI symfony

### Cloner le repo git
Placez-vous dans le répertoire souhaité et tapez la commande

``` bash 
    git clone https://github.com/Albadiia/Cosmospace.git
```

### Installer les dépendances back-end :
Tapez la commande :

``` bash 
    composer install
```

### Installer les dépendances front-end :
Tapez la commande :

``` bash 
    yarn install
```

### Installer la base de données :
**assurez vous de bien avoir réglé votre .env.local au préalable**
Tapez la commande 

``` bash
    php bin/console doctrine:database:create
``` 

pour créer la base de données.

Tapez ensuite la commande (doctrine:make:migration) :
``` bash
    php bin/console d:m:m
``` 

pour créer les tables liées aux entitées.

**Problème(s) que l'on peut rencontrer :**
Si une erreur est rencontrée lorsque vous essayer de faire la migration avec la commande ```php bin/console d:m:m```, il suffit de supprimer les migrations existantes dans le dossier /migrations, puis de rééxecuter la commande.

### Démarrer le serveur Symfony :
Tapez cette commande pour démarrer le projet :

``` bash
    symfony serve:start -d
```

et celle la pour l'arrêter.

``` bash
    symfony serve:stop
```

Tapez la commande ```symfony serve:log``` afin d'afficher les logs liées au serveur.

**Problème(s) que l'on peut rencontrer :**
Lors de l'arrêt du serveur avec la commande ```symfony serve:stop```, il est possible que celle-ci vous retourne une erreur "Access Denied".
Il s'agit d'un bug de droit d'accès au fichier /var/log/votre_fichier_de_log.log. Le serveur est bel et bien arrêté, mais le CLI de symfony ne parvient tout simplement pas à inscrire l'heure d'arrêt dans le fichier. C'est un bug qui devrait être corrigé dans les versions du CLI à venir.

### Démarrer le serveur Nuxt :
Tapez cette commande pour démarrer le projet :

``` bash
    symfony yarn dev
```

et pour l'arrêter il suffit de faire ctrl+C dans la console.

### Gestion des variables d'environnement
Les variables d'environnement sont à gérer dans un fichier .env.local propre à chaque environnement et ne doivent pas être commit sur le repo git.
Le .env n'est présent qu'à titre d'exemple afin de montrer quelles variables sont nécessaire au projet.