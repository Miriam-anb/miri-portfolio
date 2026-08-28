# Portfolio Miriam Anibaba — Application Laravel

Portfolio professionnel avec espace d'administration, construit avec **Laravel 12**, **SQLite** et **Tailwind CSS** (via CDN, sans étape de build).

## Ce que contient l'application

- **Site public** : accueil (hero, à propos, services, projets, pourquoi travailler avec moi, contact), page de détail pour chaque projet, formulaire de contact qui enregistre les messages en base de données.
- **Espace admin** (`/admin`) protégé par un mot de passe :
  - Tableau de bord (statistiques, derniers messages)
  - Paramètres du site (textes du hero, à propos, photo, coordonnées, réseaux)
  - Gestion des services (ajouter / modifier / supprimer)
  - Gestion des projets (ajouter / modifier / supprimer, y compris le workflow du projet phare)
  - Messages reçus via le formulaire de contact (lire / supprimer)

## ⚠️ Étape obligatoire avant de lancer le projet

Ce dossier contient tout le code source de l'application, mais **pas le dossier `vendor/`** (les bibliothèques PHP dont Laravel a besoin). C'est normal et volontaire : ce dossier n'est jamais partagé avec un projet Laravel (il est très lourd et se régénère automatiquement), donc il faudra l'installer une seule fois avec Composer, sur ton ordinateur qui a un accès internet normal.

### 1. Installer les dépendances

```bash
composer install
```

### 2. Configurer l'environnement

Le fichier `.env` est déjà inclus et pré-configuré (clé d'application déjà générée, base de données SQLite). Rien à faire ici sauf si tu veux changer des réglages.

Si jamais le fichier `.env` n'existe pas, copie `.env.example` puis génère une clé :

```bash
cp .env.example .env
php artisan key:generate
```

### 3. Créer la base de données et les tables

```bash
touch database/database.sqlite
php artisan migrate --seed
```

La commande `--seed` remplit automatiquement le site avec ton contenu (services, projets, paramètres) et crée le compte administrateur.

### 4. Lien pour les photos uploadées

```bash
php artisan storage:link
```

### 5. Lancer le site

```bash
php artisan serve
```

Le site est accessible sur **http://localhost:8000**, et l'espace admin sur **http://localhost:8000/admin**.

## Identifiants administrateur (à changer après la première connexion)

- **URL** : `/admin`
- **E-mail** : `admin@miriam-portfolio.test`
- **Mot de passe** : `ChangeMoi123!`

Pour changer le mot de passe, la façon la plus simple pour l'instant est d'utiliser Tinker :

```bash
php artisan tinker
>>> $u = App\Models\User::first();
>>> $u->email = "ton-email@exemple.com";
>>> $u->password = Hash::make("ton-nouveau-mot-de-passe");
>>> $u->save();
```

## Déploiement sur Railway

Un fichier `Procfile` est déjà inclus : il dit à Railway comment démarrer l'application (créer la base SQLite si besoin, lancer les migrations et le seed, puis servir le site). Étapes :

1. **Mettre le code sur GitHub** — avec GitHub Desktop (interface graphique, pas besoin de ligne de commande) ou `git`, crée un dépôt à partir de ce dossier et publie-le sur ton compte GitHub. Le `.gitignore` déjà présent exclut `vendor/` automatiquement.
2. **Créer un compte Railway** (railway.app) — le plus simple est de te connecter avec ton compte GitHub, ça les relie automatiquement.
3. **New Project → Deploy from GitHub repo** → sélectionne ton dépôt. Railway détecte que c'est un projet PHP/Laravel et installe les dépendances tout seul.
4. **Ajouter un Volume** (Railway → onglet "Volumes") monté sur `/data` — c'est l'espace de stockage permanent où vivra ta base SQLite (sans ça, tes données seraient effacées à chaque redéploiement).
5. **Définir les variables d'environnement** (onglet "Variables") :

   | Variable | Valeur |
   |---|---|
   | `APP_NAME` | `Miriam Anibaba - Portfolio` |
   | `APP_ENV` | `production` |
   | `APP_DEBUG` | `false` |
   | `APP_KEY` | *(clé fournie séparément dans le chat)* |
   | `APP_URL` | `https://ton-domaine.up.railway.app` *(à ajuster une fois le domaine généré à l'étape 6)* |
   | `DB_CONNECTION` | `sqlite` |
   | `DB_DATABASE` | `/data/database.sqlite` |
   | `SESSION_DRIVER` | `database` |
   | `CACHE_STORE` | `database` |
   | `QUEUE_CONNECTION` | `database` |
   | `LOG_CHANNEL` | `stack` |

6. **Générer un domaine public** — onglet "Settings" → "Networking" → "Generate Domain".
7. **Déployer** — Railway relance automatiquement le build. Une fois terminé, ouvre l'URL générée : le site public doit s'afficher, et `/admin` doit permettre de te connecter avec les identifiants ci-dessous.

## À compléter toi-même

Deux informations n'étaient pas encore confirmées au moment de la construction du site — modifiables directement depuis **Admin → Paramètres du site** :

- **Liens LinkedIn et GitHub** : actuellement en placeholder (`#`).
- **Numéro WhatsApp** : `22901579600` (dérivé de ton numéro de téléphone) — à vérifier/corriger si besoin.

## Stack technique

- Laravel 12 (PHP), routes classiques (pas d'API séparée)
- Base de données SQLite (fichier unique `database/database.sqlite`)
- Authentification admin maison (session, un seul compte), pas de Laravel Breeze/Jetstream
- Tailwind CSS via CDN — aucune installation Node.js/npm nécessaire
- Blade (moteur de templates de Laravel) pour toutes les vues
