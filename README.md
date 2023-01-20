# Projetshop
Notre site de e-commerce utilise une architecture basée sur le modèle-vue-contrôleur (MVC) pour offrir une expérience utilisateur fluide et efficace pour nos clients.

## Fonctionnalités
* Affichage des produits par catégories
* Ajout de produits au panier
* Passer des commandes
* Gestion du compte utilisateur (historique des commandes, modification des informations de compte, etc.)
* Gestion des paiements en ligne 
* Administration (ajout/suppression/modification des produits, gestion des commandes, etc.)

## Explication de l'architecture MVC
Notre site de e-commerce utilise l'architecture MVC (Modèle-Vue-Contrôleur) pour organiser son code et faciliter la maintenance et l'évolution du site.

### Vue
Les vues sont responsables de l'affichage des données à l'utilisateur. Elles utilisent les données fournies par les modèles et les affichent à l'aide de templates HTML. Les vues peuvent également gérer les interactions utilisateur, telles que les formulaires de recherche ou les boutons d'ajout au panier.

### Modèle
Les modèles sont responsables de la gestion des données. Ils utilisent les informations de la base de données pour fournir les données nécessaires aux vues. Les modèles peuvent également gérer les règles métier, telles que les calculs de prix ou les vérifications de stock.

### Contrôleur
Les contrôleurs gèrent les interactions entre les vues et les modèles. Ils reçoivent les requêtes de l'utilisateur, utilisent les modèles pour récupérer les données nécessaires et fournissent ces données aux vues pour affichage. Les contrôleurs peuvent également gérer les redirections et les erreurs.

En utilisant cette architecture, nous sommes en mesure de séparer les différentes parties de notre site de e-commerce de manière claire et logique, ce qui facilite la maintenance et l'évolution du site.

## Technologies utilisées
* PHP pour la programmation du backend
* MySQL pour la gestion de la base de données
* HTML, CSS, et Bootstrap pour la mise en forme et la mise en page



