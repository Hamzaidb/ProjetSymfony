# Ecommerce Symfony

Ce projet est une application e-commerce développée avec **Symfony 7**, **API Platform** et une interface d’administration.  
Il permet la gestion de produits, d’utilisateurs, de notifications et expose une API REST sécurisée pour les administrateurs.

---

## Fonctionnalités principales

- Gestion des utilisateurs (inscription, connexion, profil, points, rôles)
- Gestion des produits (CRUD, catégories, description, prix)
- Dashboard d’administration (gestion des utilisateurs, produits, notifications)
- Système de notifications
- Attribution de points aux utilisateurs actifs
- API RESTful pour les produits (accès admin uniquement)
- Authentification sécurisée (formulaire, rôles)
- Design responsive avec la police Poppins

---

## Installation

### Prérequis

- PHP >= 8.2
- Composer
- MySQL ou MariaDB
- Node.js & npm (pour les assets front si besoin)

### Étapes

1. **Cloner le projet**
   ```bash
   git clone https://github.com/Hamzaidb/ProjetSymfony.git
   cd ecommerce_symfony
   ```

2. **Installer les dépendances PHP**
   ```bash
   composer install
   ```

3. **Configurer la base de données**
   - Copier `.env` en `.env.local` et adapter la variable `DATABASE_URL` :
     ```
     DATABASE_URL="mysql://root:@127.0.0.1:3306/ecommerce_symfony?serverVersion=8.0.32"
     ```

4. **Créer la base et exécuter les migrations**
   ```bash
   php bin/console doctrine:database:create
   php bin/console doctrine:migrations:migrate
   ```

5. **(Optionnel) Charger des données de test**
   ```bash
   php bin/console doctrine:fixtures:load
   ```

6. **Installer les dépendances front (si besoin)**
   ```bash
   npm install
   # ou
   yarn install
   ```

7. **Lancer le serveur Symfony**
   ```bash
   symfony serve
   # ou
   php -S 127.0.0.1:8000 -t public
   ```

---

## Accès à l’application

- **Front office** : [http://localhost:8000/](http://localhost:8000/)
- **Back office** : [http://localhost:8000/admin](http://localhost:8000/admin)
- **API Platform** : [http://localhost:8000/api](http://localhost:8000/api)
- - **Liste des produits** : [http://localhost:8000/api/produits](http://localhost:8000/api/produits)


---

## Authentification

- Un utilisateur admin  :
  - **Email** : `hamza@gmail.com`
  - **Mot de passe** : `toto`
 
- Un utilisateur client :
  - **Email** : `user@gmail.com`
  - **Mot de passe** : `mot2passe`

---

## Structure du projet

- `src/` : Code source (entités, contrôleurs, formulaires, listeners, etc.)
- `templates/` : Templates Twig
- `assets/` : Fichiers front (CSS, JS)
- `public/` : Racine web
- `config/` : Configuration Symfony et bundles
- `migrations/` : Migrations Doctrine
- `tests/` : Tests unitaires et fonctionnels

---

## Personnalisation

- Les points, rôles, notifications et sécurité sont facilement adaptables dans les entités et contrôleurs.
- L’API peut être étendue à d’autres entités via les attributs `#[ApiResource]`.

---

