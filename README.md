# TomTroc

Site d'échange de livres entre particuliers, réalisé pour le client Alice.
Technologies : PHP 8.3, MySQL, HTML, CSS. Aucune librairie tierce. Architecture MVC.

## Ce qu'il faut avant de commencer

- WAMP installé (Apache, PHP 8.3 ou plus, MySQL)
- Un navigateur

## Installation

### 1. Récupérer le projet

Télécharger le projet depuis GitHub (bouton **Code**, puis **Download ZIP**) et le dézipper, ou le cloner :

```
git clone https://github.com/mike2492/tom-troc.git
```

Placer le dossier `tom-troc` dans `C:\wamp64\www\`.

### 2. Démarrer WAMP

Lancer WAMP et attendre que l'icône passe au vert (Apache et MySQL démarrés).

### 3. Créer la base de données

1. Ouvrir phpMyAdmin : `http://localhost/phpmyadmin`
2. Cliquer sur **Nouvelle base de données**, la nommer `tom-troc`, puis **Créer**.
3. Cliquer sur la base `tom-troc`, puis sur l'onglet **Importer**.
4. Choisir le fichier `database/schema.sql` du projet, puis **Importer**.

Le fichier crée les tables et ajoute des données de démonstration (utilisateurs, livres, messages).

### 4. Créer le fichier de configuration

Dans le dossier `config/` :

1. Copier le fichier `config.example.php`.
2. Nommer la copie `config.php`.
3. Ouvrir `config.php` et vérifier les valeurs :

| Réglage   | Rôle                      | Valeur sur WAMP |
|-----------|---------------------------|-----------------|
| `DB_HOST` | Serveur MySQL             | `localhost`     |
| `DB_NAME` | Nom de la base de données | `tom-troc`      |
| `DB_USER` | Utilisateur MySQL         | `root`          |
| `DB_PASS` | Mot de passe MySQL        | *(vide)*        |

Le fichier `config.php` n'est pas dans le dépôt volontairement : il contient des identifiants propres à chaque machine.

### 5. Ouvrir le site

Aller sur `http://localhost/tom-troc/public/`

## Compte de test

- Email : nikola75@gmail.com
- Mot de passe : avatar

## En cas de problème

- **`Failed opening required ... config.php`** : l'étape 4 n'a pas été faite. Copier `config.example.php` en `config.php`.
- **Erreur de connexion à la base** : vérifier que MySQL est démarré et que les valeurs de `config.php` sont correctes.
- **Tables introuvables** : refaire l'import de l'étape 3.
- **Page introuvable** : vérifier que le dossier s'appelle bien `tom-troc` et que l'adresse se termine par `/public/`.

## Fonctionnalités

- Inscription, connexion, déconnexion
- Compte personnel : informations et photo de profil
- Gestion de ses livres : modification, suppression, photo
- Liste des livres et fiche de chaque livre
- Profil public d'un membre
- Messagerie entre membres

## Structure du projet

```
config/     configuration
database/   script SQL
public/     point d'entrée, CSS, images envoyées
src/        contrôleurs, modèles, vues, noyau (routeur, base de données)
```

## Notes

- Une seule ligne de JavaScript : `onchange="this.form.submit()"`, pour envoyer le formulaire dès le choix d'une photo.
- Le code est formaté avec PHP CS Fixer (outil facultatif, non requis pour lancer le site).
- Améliorations prévues avant une mise en production : jeton CSRF, suppression via POST, options de sécurité des cookies de session, `.htaccess` dans `public/uploads/`.