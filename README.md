# Jobberman - Plateforme de Gestion de CV et d'Emplois

Une application web Laravel moderne permettant aux utilisateurs de créer et gérer leurs CV professionnels, ainsi que de rechercher et postuler à des offres d'emploi.

## 🚀 Fonctionnalités

- 📝 Création et gestion de CV personnalisés
- 💼 Recherche d'offres d'emploi
- 👤 Gestion de profil utilisateur
- 🔒 Authentification sécurisée
- 📱 Interface responsive

## 🛠️ Prérequis

- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL
- Git

## ⚙️ Installation

1. Clonez le dépôt
```bash
git clone https://github.com/thegoatcrseven/jobberman-projet.git
cd jobberman-projet
```

2. Installez les dépendances PHP
```bash
composer install
```

3. Installez les dépendances JavaScript
```bash
npm install
```

4. Configurez l'environnement
```bash
cp .env.example .env
php artisan key:generate
```

5. Configurez votre base de données dans le fichier `.env`
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=votre_base_de_donnees
DB_USERNAME=votre_utilisateur
DB_PASSWORD=votre_mot_de_passe
```

6. Exécutez les migrations
```bash
php artisan migrate
```

## 🚀 Lancement du projet

1. Démarrez le serveur Laravel
```bash
php artisan serve
```

2. Dans un autre terminal, compilez les assets
```bash
npm run dev
```

3. Accédez à l'application dans votre navigateur à l'adresse : `http://127.0.0.1:8000`

## 📱 Utilisation

1. Créez un compte utilisateur
2. Connectez-vous à votre compte
3. Accédez au tableau de bord pour :
   - Créer et gérer vos CV
   - Rechercher des offres d'emploi
   - Mettre à jour votre profil

## 🤝 Contribution

Les contributions sont les bienvenues ! N'hésitez pas à :
1. Fork le projet
2. Créer votre branche (`git checkout -b feature/AmazingFeature`)
3. Commit vos changements (`git commit -m 'Add some AmazingFeature'`)
4. Push vers la branche (`git push origin feature/AmazingFeature`)
5. Ouvrir une Pull Request

## 📝 License

Ce projet est sous licence MIT.
